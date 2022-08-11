@extends('layout.dashboard')
@section('title', ucwords($chart) ." "."($status)")

@section('content')
{{-- data visual detail --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-5 text-uppercase">{{ $chart ." "."($status)" }}</h1>
    <div class="table-responsive">
      <table id="table_detail_data_calon_mahasiswa" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Nama Mhs</th>
            <th>Hp</th>
            <th>Email</th>
            {{-- <th>Path Foto</th>
            <th>Path Rapor</th>
            <th>Path Bayar</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($chartData as $data)
          <tr>
            <td>{{ $data->nama_mhs }}</td>
            <td>{{ $data->hp_mhs }}</td>
            <td>{{ $data->email }}</td>
            {{-- <td>{{ $data->path_foto }}</td>
            <td>{{ $data->path_rapor }}</td>
            <td>{{ $data->path_bayar }}</td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
{{-- data visual detail --}}
@endsection

@push('script')
<script>
  $('#table_detail_data_calon_mahasiswa').DataTable();
</script>
@endpush