@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Edit Categories</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('categories.update', $category->id) }}">
                        @method('PATCH')
                        @csrf
                        <label for="name">Category</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$category->category_name}}">
                        <label for="parent">Parent</label>
                        <select name="parent" id="parent" class="form-control">

                            <option value=""></option>

                            @foreach ($allCategories as $cat)
                                <option value="{{ $cat->id }}" {{ ($category->parent == $cat->id) ? 'selected' : '' }} >{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug}}">
                        <label for="category_view">Category View</label>
                        <select name="category_view" id="category_view" class="form-control">
                            <option value="0" {{ $category->category_view == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $category->category_view == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        <label for="is_home">Is home</label>
                        <select name="is_home" id="is_home" class="form-control">
                            <option value="0" {{ $category->is_home == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $category->is_home == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        <label for="is_menu">Is menu</label>
                        <select name="is_menu" id="is_menu" class="form-control">
                            <option value=""></option>
                            <option value="0" {{ $category->is_menu == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $category->is_menu == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        <label for="is_enable">Is enable</label>
                        <select name="is_enable" id="is_enable" class="form-control">
                            <option value="0" {{ $category->is_enable == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $category->is_enable == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
