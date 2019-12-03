<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\LogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configuration::paginate(15);

        return view('configurations.index')->withConfigurations($configurations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuration = Configuration::find($id);

        return view('configurations.edit')->withConfiguration($configuration);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\configurations  $configurations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'description' => 'required'
        ]);

        $configuration = Configuration::find($id);
        $user_name = Auth::user()->username;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $request->name. '.' .$image->getClientOriginalExtension();

            $configuration->image = $image_name;
        }

        $configuration->config_name = $request->name;
        $configuration->description = $request->description;

        $configuration->created_by = Auth::user()->id;

        if ($configuration->save()) {

            if (!empty($image)) {
                $destination = 'images/configurations';
                $image->move($destination, $image_name);
            }

            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name updated $configuration->config_name configuration";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/configurations');
        } else {
            return redirect('dashboard/configurations/create')->with('error', 'Failed to save category');
        }
    }
}
