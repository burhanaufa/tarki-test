<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('user_role.create')->with('user_id', $user_id)->withRoles($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'roles' => 'required|array'
        ]);

        $user = User::find($request->user_id);
        $user->roles()->attach($request->roles);

        return redirect()->route('users');
    }
}
