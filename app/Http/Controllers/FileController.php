<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\LogUser;
use App\File;

class FileController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        return view('files.create')->with('post_id', $post_id);
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
            'post_id' => 'required|integer',
            'filename' => 'required',
            'filename.*' => 'mimes:doc,pdf,docx,zip,jpg,png,jpeg,gif,mp4,mkv,m4a,avi,mov'
        ]);

        $user_name = Auth::user()->username;

        $file_idx = 0;
        foreach($request->file('filename') as $file)
        {
            $ext = strtolower($file->getClientOriginalExtension());
            $code = base64_encode($file_idx. '' .date('Y-m-d H:i:s'));
            $name = str_replace(' ', '-', strtolower(substr($code. '' .$file->getClientOriginalName(), -50, 50)));
            $file->move(public_path().'/images/posts/', $name);

            $new_file = new File;
            $new_file->post_id = $request->post_id;
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
        $log_user->description = "User $user_name added files to files table";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect()->route('files.show', $request->post_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $files = File::where('post_id', $post_id)->paginate(15);

        return view('files.show')->withFiles($files)->with('post_id', $post_id);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('set_is_cover')) {
            if ($request->has('is_cover')) {
                $files = File::where('post_id', $id)->get();

                if ($files->count() > 0) {
                    foreach ($files as $file) {
                        $file->is_cover = '0';
                        $file->save();
                    }
                }

                $file = File::find($request->is_cover);
                $file->is_cover = '1';
                $file->save();

                return redirect()->route('files.show', $id);
            }
        }

        if ($request->has('delete')) {
            if ($request->has('deletes')) {
                foreach ($request->deletes as $id) {
                    $file = File::find($id);
                    $file->delete();
                }
            }

            return redirect()->route('files.show', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $post_id)
    {
        $file = File::find($id);

        $user_name = Auth::user()->username;

        $myFile = public_path(). '/images/posts/' .$file->file_name;

        if (is_file($myFile)) {
            unlink($myFile);
        }

        $file->delete();

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted $file->file_name";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect()->route('files.show', $post_id);
    }
}
