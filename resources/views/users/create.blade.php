@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Add User</h3>
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
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
