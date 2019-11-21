@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Add Categories</h3>
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
                    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Category</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="parent">Parent</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                        <label for="category_view">Category View</label>
                        <select name="category_view" id="category_view" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <label for="is_home">Is home</label>
                        <select name="is_home" id="is_home" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <label for="is_menu">Is menu</label>
                        <select name="is_menu" id="is_menu" class="form-control">
                            <option value=""></option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        <label for="is_enable">Is enable</label>
                        <select name="is_enable" id="is_enable" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
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
