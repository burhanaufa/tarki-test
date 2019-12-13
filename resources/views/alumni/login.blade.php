@extends('layouts.app')
@section('content')
<div class="login-box">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
        
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="login-logo">
      <a href="#"><b>Portal</b> Alumni</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ route('alumni-login') }}" method="post">
          @csrf
          <div class="input-group mb-3">
              <select class="form-control" id="regions" name="regions">
                  <option value="null">-- Pilih Wilayah --</option>
                  @foreach($regions as $item)
                  <option value="{{$item->url}}">{{$item->region_name}}</option>
                  @endforeach
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-map"></span>
                </div>
              </div>
          </div>
          <div class="input-group mb-3">
            <input id="username" type="username" class="form-control" placeholder="Nomer Induk Siswa" name="nis" required autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"placeholder="Password" required autocomplete="current-password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection
