<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogUser;

class LogUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $log_users = LogUser::paginate(15);

        return view('log_users.index')->with('log_users', $log_users);
    }
}
