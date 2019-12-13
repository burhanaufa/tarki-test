<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\LogUser;
use App\User;

class UserController extends Controller
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
        $users = User::paginate(15);

        $permissions = array();
        $roles = Auth::user()->roles;
        foreach ($roles as $key => $val) {
            foreach ($val->permissions as $permission) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        return view('users.index')->withUsers($users)->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'username' => 'required|max:50',
            'email' => 'required|email|max:255',
            'fullname' => 'required|max:50',
            'password' => 'required|confirmed|max:255',
            'status' => 'required'
        ]);

        $user_name = Auth::user()->username;

        try {
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->full_name = $request->fullname;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->created_by = Auth::user()->id;
            $user->save();

            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name added user $user->username";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/users');
        } catch (\Throwable $th) {
            throw $th;
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
        $user = User::find($id);
        return view('users.edit')->withUser($user);
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
            'username' => 'required|max:50',
            'email' => 'required|email|max:255',
            'fullname' => 'required|max:50',
            'old_password' => 'required|max:255',
            'password' => 'confirmed|max:255',
            'status' => 'required'
        ]);

        $user_name = Auth::user()->username;

        try {
            $user = User::find($id);

            if (Hash::check($request->old_password, $user->password)) {
                $user->username = $request->username;
                $user->email = $request->email;
                $user->full_name = $request->fullname;

                if (!empty($request->input('password'))) {
                    $user->password = Hash::make($request->password);
                }

                $user->status = $request->status;
                $user->created_by = Auth::user()->id;
                $user->save();

                $log_user = new LogUser;
                $log_user->ip_address = $request->ip();
                $log_user->user_agent = $request->header('User-Agent');
                $log_user->url = $request->url();
                $log_user->description = "User $user_name updated user $user->username";
                $log_user->created_by = Auth::user()->id;
                $log_user->save();

                return redirect('dashboard/users');
            } else {
                return redirect("dashboard/users/$user->id/edit")->withErrors('Wrong Password!');
            }

        } catch (\Throwable $th) {
            throw $th;
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
        $user = User::find($id);
        $user_name = Auth::user()->username;
        $user->delete();

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted role $user->username";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/users');
    }
}
