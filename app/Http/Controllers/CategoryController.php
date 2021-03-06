<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\LogUser;

class CategoryController extends Controller
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
        $categories = Category::paginate(15);

        $permissions = array();
        $roles = Auth::user()->roles;
        foreach ($roles as $key => $val) {
            foreach ($val->permissions as $permission) {
                $permissions[$permission->id] = $permission->name;
            }
        }

        return view('categories.index')->withCategories($categories)->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('categories.create')->withCategories($categories);
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
            'name' => 'required|max:50'
        ]);

        $user_name = Auth::user()->username;

        $category = new Category;
        $category->category_name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        if ($request->has('parent')) {
            $category->parent = $request->parent;
        }

        if ($request->has('category_view')) {
            $category->category_view = $request->category_view;
        }

        if ($request->has('is_home')) {
            $category->is_home = $request->is_home;
        }

        if ($request->has('is_menu')) {
            $category->is_menu = $request->is_menu;
        }

        if ($request->has('is_enable')) {
            $category->is_enable = $request->is_enable;
        }

        $category->created_by = Auth::user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = str_replace(' ', '-', strtolower($request->name. '.' .$image->getClientOriginalExtension()));
            $category->image = $image_name;
            $destination = 'images/categories';
            $image->move($destination, $image_name);
        }

        if ($category->save()) {
            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name created $category->category_name category";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/categories');
        } else {
            return redirect('dashboard/categories/create')->with('error', 'Failed to save category');
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
        $category = Category::find($id);
        $allCategories = Category::where('id', '!=', $category->id)->get();

        return view('categories.edit')->withCategory($category)->withAllCategories($allCategories);
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
            'name' => 'required|max:50'
        ]);

        $category = Category::find($id);
        $user_name = Auth::user()->username;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = str_replace(' ', '-', strtolower($request->name. '.' .$image->getClientOriginalExtension()));

            $category->image = $image_name;
        }

        if ($request->has('name')) {
            $category->category_name = $request->name;
        }

        if ($request->has('slug')) {
            $category->slug = Str::slug($request->name, '-');
        }

        if ($request->has('parent')) {
            $category->parent = $request->parent;
        }

        if ($request->has('category_view')) {
            $category->category_view = $request->category_view;
        }

        if ($request->has('is_home')) {
            $category->is_home = $request->is_home;
        }

        if ($request->has('is_menu')) {
            $category->is_menu = $request->is_menu;
        }

        if ($request->has('is_enable')) {
            $category->is_enable = $request->is_enable;
        }

        $category->created_by = Auth::user()->id;

        if ($category->save()) {

            if (!empty($image)) {
                $destination = 'images/categories';
                $image->move($destination, $image_name);
            }

            $log_user = new LogUser;
            $log_user->ip_address = $request->ip();
            $log_user->user_agent = $request->header('User-Agent');
            $log_user->url = $request->url();
            $log_user->description = "User $user_name updated $category->category_name category";
            $log_user->created_by = Auth::user()->id;
            $log_user->save();

            return redirect('dashboard/categories');
        } else {
            return redirect('dashboard/categories/create')->with('error', 'Failed to save category');
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
        $category = Category::find($id);

        $user_name = Auth::user()->username;

        if (!empty($category->image)) {
            $myFile = public_path(). '/images/categories/' .$category->image;
            if (is_file($myFile)) {
                unlink($myFile);
            }
        }

        $category->delete();

        $log_user = new LogUser;
        $log_user->ip_address = \Request::ip();
        $log_user->user_agent = \Request::header('User-Agent');
        $log_user->url = \Request::url();
        $log_user->description = "User $user_name deleted $category->category_name category";
        $log_user->created_by = Auth::user()->id;
        $log_user->save();

        return redirect('dashboard/categories');
    }
}
