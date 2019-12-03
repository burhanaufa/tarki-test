@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Add Region</h3>
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
                    <form action="{{ route('regions.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Region</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="url">URL</label>
                        <input type="text" class="form-control" id="url" name="url">
                        <label for="parent">Parent</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value=""></option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                            @endforeach
                        </select>
                        <label for="icon">Icon</label>
                        <input type="file" name="icon" id="icon" class="form-control">
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
