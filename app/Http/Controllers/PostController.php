<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\File;
use App\LogUser;
use App\Category;

class PostController extends Controller
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
        $posts = Post::paginate(15);

        $permissions = array();
        $roles = Auth::user()->roles;
        foreach ($roles as $key => $val) {
            foreach ($val->permissions as $permission) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        return view('posts.index')->withPosts($posts)->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
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
            'title' => 'required|max:50',
            'category_id' => 'required|integer|max:20',
            'headline' => 'required|max:100',
            'description' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:doc,pdf,docx,zip,jpg,png,jpeg,gif,mp4,mkv,m4a,avi,mov'
        ]);

        $user_name = Auth::user()->username;

        try {
            $post = new Post;
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->headline = $request->headline;
            $post->description = $request->description;
            $post->slug = Str::slug($request->title);
            $post->created_by = Auth::user()->id;
            $post->save();

            $file_idx = 0;
            foreach($request->file('filename') as $file)
            {
                $ext = $file->getClientOriginalExtension();
                $code = base64_encode($file_idx. '' .date('Y-m-d H:i:s'));
                $name = str_replace(' ', '-', strtolower(substr($code. '' .$file->getClientOriginalName(), -50, 50)));
                $file->move(public_path().'/images/posts/', $name);

                $new_file = new File;
                $new_file->post_id = $post->id;
                $new_file->file_name = $name;

                $img = array('jpg', 'jpeg', 'png','gif');
                $vid = array('mp4','mkv','m4a','avi','mov');

                if (in_array($ext, $img)) {
                    $new_file->file_format = 'img';
                }
                elseif (in_array($ext, $vid)) {
                    $new_file->file_format = 'img';
                }
                else {
                    $new_file->file_format = 'doc';
                }

                $new_file->created_by = Auth::user()->id;
                $new_file->save();

                $file_idx++;
            }

            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name added $post->title to posts";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/posts');

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
        $categories = Category::all();
        $post = Post::find($id);

        return view('posts.edit')->withCategories($categories)->withPost($post);
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
            'title' => 'required|max:50',
            'category_id' => 'required|integer|max:20',
            'headline' => 'required|max:100',
            'description' => 'required',
            'filename.*' => 'mimes:doc,pdf,docx,zip,jpg,png,jpeg,gif,mp4,mkv,m4a,avi,mov'
        ]);

        $user_name = Auth::user()->username;

        try {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->headline = $request->headline;
            $post->description = $request->description;
            $post->slug = Str::slug($request->title);
            $post->created_by = Auth::user()->id;
            $post->save();

            if ($request->hasFile('filename')) {
                $file_idx = 0;
                foreach($request->file('filename') as $file)
                {
                    $ext = $file->getClientOriginalExtension();
                    $code = base64_encode($file_idx. '' .date('Y-m-d H:i:s'));
                    $name = str_replace(' ', '-', strtolower(substr($code. '' .$file->getClientOriginalName(), -50, 50)));
                    $file->move(public_path().'/images/posts/', $name);

                    $new_file = new File;
                    $new_file->post_id = $post->id;
                    $new_file->file_name = $name;

                    $img = array('jpg', 'jpeg', 'png','gif');
                    $vid = array('mp4','mkv','m4a','avi','mov');

                    if (in_array($ext, $img)) {
                        $new_file->file_format = 'img';
                    }
                    elseif (in_array($ext, $vid)) {
                        $new_file->file_format = 'img';
                    }
                    else {
                        $new_file->file_format = 'doc';
                    }

                    $new_file->created_by = Auth::user()->id;
                    $new_file->save();

                    $file_idx++;
                }
            }

            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name updated $post->title post";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/posts');

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
        $files = File::where('post_id', $id);

        $user_name = Auth::user()->username;

        foreach ($files->get() as $file) {
            $myFile = public_path(). '/images/posts/' .$file->file_name;
            if (is_file($myFile)) {
                unlink($myFile);
            }
        }

        $files->delete();

        $post = Post::find($id);
        $post->delete();

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted $post->title post";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/posts');
    }
}
