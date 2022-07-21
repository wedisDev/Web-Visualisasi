@extends('layout.auth')
@section('title', 'Login')

@section('content')
<div class="left_side"></div>
<div class="right_side">
  <div class="wrapper">
    <img src="{{ asset('assets/images/logo-undika.png') }}" alt="logo undika" class="img-fluid">
    <form action="{{ route('auth.login.action') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username">
        @error('username')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password">
        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-secondary text-uppercase">Masuk</button>
      </div>
    </form>
  </div>
</div>
@endsection