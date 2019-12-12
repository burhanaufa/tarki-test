<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\File;
use App\Comment;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public function index(){
        $data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        return view('home',$data);
    }
     public function page($slug){
     	$data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        $data['page'] = Post::select('*', 'posts.id as posts_id')->join('categories', 'categories.id','=','posts.category_id')->where('slug', $slug)->first();
        if($data['page'] != null){
        $data['files'] = File::where('post_id', $data['page']->posts_id)->get();
    	}else{
     		$data['files'] = null;
     	}
        return view('page',$data);
    }
     public function lists($slug){
     	$data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        $data['page'] = Category::where('slug', $slug)->first();
        $data['posts'] = Post::select('*', 'posts.id as posts_id')->join('categories', 'categories.id','=','posts.category_id')->where('slug', $slug)->where('status', '1')->get();
        $data['files'] = File::all();
        return view('list-posts',$data);
    }
    public function detail_post($id){
     	$data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        $data['post'] = Post::select('*', 'posts.id as posts_id')->join('categories', 'categories.id','=','posts.category_id')->where('posts.id', $id)->where('status', '1')->first();
        if($data['post'] != null){
         $data['files'] = File::where('post_id', $data['post']['posts_id'])->get();
         $data['comments'] = Comment::where('post_id', $data['post']['posts_id'])->where('status', '1')->get();
     	}else{
     		$data['files'] = null;
     		$data['comments'] = null;
     	}
        return view('detail-post',$data);
    }
    public function add_comment(Request $request, $id){

        if(Comment::create([
            'post_id' => $id,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'blog' => $request->blog,
            'comment' => $request->comment,
            'created_by' => 1,
            'status' => '0'
        ])){
            return  back()->with('success','Komentar sukses dikirim !');
        }else{
            return back()->withErrors(['Ada kesalahan pada saat Input.']);
        }
    }
}
