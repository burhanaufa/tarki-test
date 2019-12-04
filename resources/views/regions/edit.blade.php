@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Edit Regions</h3>
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
                    <form method="post" action="{{ route('regions.update', $region->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <label for="name">Region</label>
                        <input type="text" value="{{ $region->region_name }}" class="form-control" id="name" name="name">
                        <label for="url">URL</label>
                        <input type="text" value="{{ $region->url }}" class="form-control" id="url" name="url">
                        <label for="parent">Parent</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value=""></option>
                            @foreach ($allRegions as $reg)
                                <option value="{{ $reg->id }}" {{ ($region->parent == $reg->id) ? 'selected' : '' }} >{{ $reg->region_name }}</option>
                            @endforeach
                        </select>
                        <label for="icon">Icon</label>
                        <input type="file" name="icon" id="icon" class="form-control">
                        @if (!empty($region->icon))
                            <img src="{{ env('APP_URL'). '/images/icons/' .$region->icon }}" alt="">
                        @endif
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
