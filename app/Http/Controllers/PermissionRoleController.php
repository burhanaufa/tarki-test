<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LogUser;
use App\Permission;
use App\Role;

class PermissionRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($role_id)
    {
        $permissions = Permission::all();
        $permission_id = array();

        $role = Role::find($role_id);
        $permission_roles = $role->permissions;

        foreach ($permission_roles as $permission_role) {
            $permission_id[] = $permission_role->id;
        }

        return view('permission_role.create')->with('role_id', $role_id)->with('permission_id', $permission_id)
                                            ->withPermissions($permissions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|integer'
        ]);

        $user_name = Auth::user()->username;

        $permissions = array();

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permission) {
                $permissions[$permission]['created_by'] = Auth::user()->id;
            }
        }

        $role = Role::find($request->role_id);
        $role->permissions()->sync($permissions);

        $log_user = new LogUser;
        $log_user->ip_address = $request->ip();
        $log_user->user_agent = $request->header('User-Agent');
        $log_user->url = $request->url();
        $log_user->description = "User $user_name added permission to $role->role_name";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect()->route('roles.index');
    }
}
