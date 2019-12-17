<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LogUser;
use App\Region;
use App\User;
use App\Role;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($user_id)
    {
        $roles = Role::all();
        $role_id = array();

        $user = User::find($user_id);
        $user_roles = $user->roles;

        $regions = Region::all();

        foreach ($user_roles as $user_role) {
            $role_id[] = $user_role->id;
        }

        return view('user_role.create')->with('user_id', $user_id)->withRegions($regions)
                                        ->with('role_id', $role_id)->withRoles($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'roles' => 'required|array'
        ]);

        $user_name = Auth::user()->username;

        $roles = array();
        $region_id = NULL;
        if ($request->has('region_id')) {
            $region_id = $request->region_id;
        }

        foreach ($request->roles as $role) {
            $roles[$role]['created_by'] = Auth::user()->id;
            $roles[$role]['region_id'] = $region_id;
        }

        $user = User::find($request->user_id);
        $user->roles()->sync($roles);

        $log_user = new LogUser;
        $log_user->ip_address = $request->ip();
        $log_user->user_agent = $request->header('User-Agent');
        $log_user->url = $request->url();
        $log_user->description = "User $user_name added user role to $user->username";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect()->route('users.index');
    }
}
