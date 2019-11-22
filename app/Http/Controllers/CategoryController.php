<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;

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
        $categories = Category::all();

        return view('categories.index')->withCategories($categories);
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
            'name' => 'required|max:50',
            'slug' => 'required'
        ]);

        $category = new Category;
        $category->category_name = $request->name;
        $category->slug = $request->slug;
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
            $image_name = $request->name. '.' .$image->getClientOriginalExtension();
            $category->image = $image_name;
            $destination = 'images/categories';
            $image->move($destination, $image_name);
        }

        if ($category->save()) {
            return redirect('categories');
        } else {
            return redirect('categories/create')->with('error', 'Failed to save category');
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
        $allCategories = Category::all();

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
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $request->name. '.' .$image->getClientOriginalExtension();

            $category->image = $image_name;
        }

        $category = Category::find($id);

        if ($request->has('category_name')) {
            $category->category_name = $request->name;
        }

        if ($request->has('slug')) {
            $category->slug = $request->slug;
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

            return redirect('categories');
        } else {
            return redirect('categories/create')->with('error', 'Failed to save category');
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
        $category->delete();

        return redirect('categories');
    }
}
