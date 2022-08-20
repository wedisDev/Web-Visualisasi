@extends('layout.auth')
@section('title', 'Masuk')

@section('content')
<div class="left_side"></div>
<div class="right_side">
  <div class="wrapper">
    <img src="{{ asset('assets/images/visit-penmaru.png') }}" alt="logo visit penmaru" height="80px" class="mb-4">
    @if (session()->get('message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('message') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
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
        <button type="submit" class="btn btn-danger text-uppercase"><b>Masuk</b></button>
      </div>
    </form>
  </div>
</div>
@endsection