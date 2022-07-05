@extends('layout.dashboard')

@section('content')
{{-- pengguna --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Ubah Pengguna</h1>
    <div class="card mt-5">
      <div class="card-body">
        <form action="" method="POST">
          <div class="mb-3 row">
            <label for="id_pengguna" class="col-sm-2 col-form-label">ID Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="id_pengguna" name="id_pengguna"
                placeholder="WR_001 = Warek, KB_001 = Kabag, ST_001 = Staf">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nama_pengguna" class="col-sm-2 col-form-label">Nama Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                placeholder="masukkan nama pengguna">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" placeholder="masukkan email">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="masukkan jabatan">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="username" name="username" placeholder="masukkan username">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="password" name="password" placeholder="masukkan password">
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-light">Simpan</button>
            <button type="button" class="btn btn-light">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
{{-- pengguna --}}
@endsection