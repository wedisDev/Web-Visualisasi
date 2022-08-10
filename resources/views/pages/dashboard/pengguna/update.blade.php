@extends('layout.dashboard')
@section('title', 'Ubah Pengguna')

@section('content')
{{-- pengguna --}}
<section>
  <div class="container my-4">
    <h1 class="h4">UBAH PENGGUNA</h1>
    <div class="card mt-4">
      <div class="card-body">
        <form action="{{ route('pengguna.update.action', $pengguna->id_pengguna) }}" method="POST">
          @csrf
          @method('put')
          <div class="mb-3 row">
            <label for="id_pengguna" class="col-sm-2 col-form-label">ID Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_pengguna" name="id_pengguna"
                value="{{ $pengguna->id_pengguna }}" readonly
                placeholder="WR_001 = Warek, KB_001 = Kabag, ST_001 = Staf">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama_pengguna" class="col-sm-2 col-form-label">Nama Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                value="{{ $pengguna->nama_pengguna }}" placeholder="masukkan nama pengguna">
              @error('nama_pengguna')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email_pengguna" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email_pengguna" name="email_pengguna"
                value="{{ $pengguna->email_pengguna }}" placeholder="masukkan email">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="jabatan_pengguna" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
              <select class="form-select" id="jabatan_pengguna" name="jabatan_pengguna">
                @foreach ($jabatan as $loopItem)
                @if ($loopItem == $pengguna->jabatan_pengguna)
                <option value="{{ $loopItem }}" class="text-capitalize" selected>{{ $loopItem }}</option>
                @else
                <option value="{{ $loopItem }}" class="text-capitalize">{{ $loopItem }}</option>
                @endif
                @endforeach
              </select>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" value="{{ $pengguna->username }}"
                placeholder="masukkan username">
              @error('username')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              {{-- ini buat nampilin passwordnya mas daffa 😁 --}}
              <input type="text" class="form-control" id="password" name="password" value="{{ $pengguna->password }}"
                placeholder="masukkan password">
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('pengguna.index') }}" class="btn btn-danger mx-2">batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
{{-- pengguna --}}
@endsection