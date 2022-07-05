@extends('layout.dashboard')

@section('content')
{{-- pengguna --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Pencatatan Pengguna</h1>
    <a href="{{ route('pengguna.create.view') }}" class="btn btn-light mt-5 mb-4">Tambah Pengguna</a>
    <div class="table-responsive">
      <table id="table_pengguna" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Pengguna</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
          </tr>
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
          </tr>
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
          </tr>
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011-04-25</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>
{{-- pengguna --}}
@endsection

@push('script')
<script>
  $(document).ready(function () {
    $('#table_pengguna').DataTable();
  });
</script>
@endpush