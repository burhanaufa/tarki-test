<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use App\LogUser;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(15);

        return view('permissions.index')->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.create');
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
            'name' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $permission = new Permission;
        $permission->name = $request->name;
        $permission->created_by = Auth::user()->id;

        if ($permission->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name added $permission->name to permissions";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/permissions');
        } else {
            return redirect('dashboard/permissions/create')->withErrors('Failed to save permission!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);

        return view('permissions.edit')->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->created_by = Auth::user()->id;

        if ($permission->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name updated $permission->name";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/permissions');
        } else {
            return redirect("dashboard/permissions/$permission->id/edit")->withErrors('Failed to save permission!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        $user_name = Auth::user()->username;

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted permission $permission->name";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/permissions');
    }
}
