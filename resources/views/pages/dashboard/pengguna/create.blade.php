@extends('layout.dashboard')
@section('title', 'Tambah Pengguna')

@section('content')
{{-- pengguna --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Tambah Pengguna</h1>
    <div class="card mt-5">
      <div class="card-body">
        <form action="{{ route('pengguna.create.action') }}" method="POST">
          @csrf
          <div class="mb-3 row">
            <label for="id_pengguna" class="col-sm-2 col-form-label">ID Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_pengguna" name="id_pengguna"
                placeholder="WR_001 = Warek, KB_001 = Kabag, ST_001 = Staf">
              @error('id_pengguna')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama_pengguna" class="col-sm-2 col-form-label">Nama Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                placeholder="masukkan nama pengguna">
              @error('nama_pengguna')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email_pengguna" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_pengguna" name="email_pengguna"
                placeholder="masukkan email">
              @error('email')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="jabatan_pengguna" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
              <select class="form-select" id="jabatan_pengguna" name="jabatan_pengguna">
                <option value="warek" selected>Warek</option>
                <option value="kabag">Kabag</option>
                <option value="staf">Staf</option>
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username">
              @error('username')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" name="password" placeholder="masukkan password">
              @error('password')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-light">Tambah</button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-light">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
{{-- pengguna --}}
@endsection