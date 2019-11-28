@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Edit Posts</h3>
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
                    <form method="post" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ ($post->category_id == $category->id) ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="headline">Headline</label>
                        <textarea name="headline" id="headline" cols="30" rows="10" class="form-control">
                            {!! $post->headline !!}
                        </textarea>
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                            {!! $post->description !!}
                        </textarea>
                        <label>File</label>
                        <div class="clone d-none">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Remove</button>
                                    </div>
                            </div>
                        </div>
                        <div class="input-group control-group increment" >
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button"><i class="fa fa-plus"></i>Add</button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").before(html);
            });

            $("body").on("click",".btn-danger",function(){
                $(this).parents(".control-group").remove();
            });

        });
    </script>
@endpush
