<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        foreach ($user_roles as $user_role) {
            $role_id[] = $user_role->id;
        }

        return view('user_role.create')->with('user_id', $user_id)
                                        ->with('role_id', $role_id)->withRoles($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'roles' => 'required|array'
        ]);

        $roles = array();

        foreach ($request->roles as $role) {
            $roles[$role]['created_by'] = Auth::user()->id;
        }

        $user = User::find($request->user_id);
        $user->roles()->attach($roles);

        return redirect()->route('users.index');
    }
}
