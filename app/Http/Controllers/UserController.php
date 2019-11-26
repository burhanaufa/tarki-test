<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index')->withUsers($users);
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

        try {
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->full_name = $request->fullname;
            $user->password = Hash::make($request->password);
            $user->status = $request->status;
            $user->created_by = Auth::user()->id;
            $user->save();

            return redirect('users');
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

                return redirect('users');
            } else {
                return redirect("users/$user->id/edit")->withErrors('Wrong Password!');
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
        $user->delete();

        return redirect('users');
    }
}
