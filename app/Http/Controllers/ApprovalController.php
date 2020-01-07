<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Post;
use App\LogUser;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($what)
    {
        ($what == "post") ? $approval = Post::paginate(15) : $approval = Comment::paginate(15);

        $permissions = array();
        $roles = Auth::user()->roles;
        foreach ($roles as $key => $val) {
            foreach ($val->permissions as $permission) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        if ($what == "post") {
            return view('approval.post.index')->withApprovals($approval)->withPermissions($permissions);
        } else {
            // dd($approval);
            return view('approval.comment.index')->withApprovals($approval)->withPermissions($permissions);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $user_name = Auth::user()->username;

        try {
            ($request->what == "post") ? $update_status_post = Post::find($id) : $update_status_post = Comment::find($id);
            $update_status_post->status = $request->status;
            $update_status_post->save();
        } catch (\Throwable $th) {
            throw $th;
        }

        $log_user = new LogUser;
        $log_user->ip_address = $request->ip();
        $log_user->user_agent = $request->header('User-Agent');
        $log_user->url = $request->url();
        $log_user->description = "User $user_name updated $update_status_post->title status";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        if ($request->what == "post") {
            return redirect('dashboard/approval/post');
        } else {
            return redirect('dashboard/approval/comment');
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
        //
    }
}
