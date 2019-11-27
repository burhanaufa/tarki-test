<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Controllers\Controller;
class HomeController extends Controller
{
    public function index(){
        $data['top_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent', null)->get();
        $data['sub_menu_parent'] = Category::where('is_menu', '1')->where('is_enable', '1')->where('parent','!=', null)->get();
        return view('home',$data);
    }

}
