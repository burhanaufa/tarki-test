@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Edit Configuration</h3>
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
                    <form method="post" action="{{ route('configurations.update', $configuration->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $configuration->config_name }}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">
                            {!! $configuration->description !!}
                        </textarea>
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if (!empty($configuration->image))
                            <img src="{{ env('APP_URL'). '/images/configurations/' .$configuration->image }}" alt="">
                        @endif
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
