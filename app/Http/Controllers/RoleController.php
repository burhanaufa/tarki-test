<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LogUser;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(15);

        $permissions = array();
        $user_roles = Auth::user()->roles;
        foreach ($user_roles as $key => $val) {
            foreach ($val->permissions as $permission) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        return view('roles.index')->withRoles($roles)->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'rolename' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $role = new Role;
        $role->role_name = $request->rolename;
        $role->created_by = Auth::user()->id;

        if ($role->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name added $role->role_name to roles";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/roles');
        } else {
            return redirect('dashboard/roles/create')->withErrors('Failed to save role!');
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
        $role = Role::find($id);

        return view('roles.edit')->withRole($role);
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
            'rolename' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $role = Role::find($id);
        $role->role_name = $request->rolename;
        $role->created_by = Auth::user()->id;

        if ($role->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name updated $role->role_name";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/roles');
        } else {
            return redirect("dashboard/roles/$role->id/edit")->withErrors('Failed to save role!');
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
        $role = Role::find($id);
        $role->delete();

        $user_name = Auth::user()->username;

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted role $role->role_name";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/roles');
    }
}
