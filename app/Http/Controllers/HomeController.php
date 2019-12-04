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
        $data['files'] = File::where('post_id', $data['page']->posts_id)->get();
        return view('page',$data);
    }
     public function lists($slug){
     	$data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        $data['page'] = Category::where('slug', $slug)->first();
        $data['posts'] = Post::select('*', 'posts.id as posts_id')->join('categories', 'categories.id','=','posts.category_id')->where('slug', $slug)->get();
        return view('list-posts',$data);
    }
    public function detail_post($id){
     	$data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        $data['post'] = Post::select('*', 'posts.id as posts_id')->join('categories', 'categories.id','=','posts.category_id')->where('posts.id', $id)->first();
         $data['files'] = File::where('post_id', $data['post']['posts_id'])->get();
        return view('detail-post',$data);
    }
    public function add_comment(Request $request, $id){

        if(Comment::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'blog' => $request->blog,
            'comment' => $request->comment,
            'post_id' => $id
        ])){
            return  back()->with('success','Data sukses ditambahkan !');
        }else{
            return back()->withErrors(['Ada kesalahan pada saat Input.']);
        }
    }
}
