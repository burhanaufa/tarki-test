@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Add Role</h3>
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
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <label for="rolename">Rolename</label>
                        <input type="text" class="form-control" id="rolename" name="rolename">
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
