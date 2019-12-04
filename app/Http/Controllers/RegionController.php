<?php

namespace App\Http\Controllers;

use App\Region;
use App\LogUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::paginate(15);

        return view('regions.index')->withRegions($regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('regions.create')->withRegions($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'url' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $region = new Region;
        $region->region_name = $request->name;
        $region->url = $request->url;
        $region->created_by = Auth::user()->id;

        if ($request->has('parent')) {
            $region->parent = $request->parent;
        }

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $image_name = $request->name. '.' .$image->getClientOriginalExtension();
            $region->icon = $image_name;
            $destination = 'images/icons';
            $image->move($destination, $image_name);
        }

        if ($region->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name created $region->region_name region";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/regions');
        } else {
            return redirect('dashboard/regions/create')->with('error', 'Failed to save region');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::find($id);
        $allRegions = Region::where('id', '!=', $region->id)->get();

        return view('regions.edit')->withRegion($region)->withAllRegions($allRegions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50',
            'url' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $region = Region::find($id);
        $region->region_name = $request->name;
        $region->url = $request->url;
        $region->created_by = Auth::user()->id;

        if ($request->has('parent')) {
            $region->parent = $request->parent;
        }

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $image_name = $request->name. '.' .$image->getClientOriginalExtension();
            $region->icon = $image_name;
            $destination = 'images/icons';
            $image->move($destination, $image_name);
        }

        if ($region->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name created $region->region_name region";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/regions');
        } else {
            return redirect('dashboard/regions/create')->with('error', 'Failed to save region');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);

        $user_name = Auth::user()->username;

        if (!empty($region->icon)) {
            $myFile = public_path(). '/images/icons/' .$region->icon;
            if (is_file($myFile)) {
                unlink($myFile);
            }
        }

        $region->delete();

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted $region->region_name region";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/regions');
    }
}
