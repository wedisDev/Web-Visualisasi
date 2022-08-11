@extends('layout.dashboard')
@section('title', $title)

@section('content')
{{-- data visual detail --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-5">Tipe Dan Status Sekolah ({{ $title }})</h1>
    <div class="table-responsive">
      <table id="table_tipe_dan_status_sekolah" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Nama Sekolah</th>
            <th>Kota Sekolah</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($chartData as $data)
          <tr>
            <td>{{ $data->nama_sekolah }}</td>
            <td>{{ $data->nama_kota }}</td>
            <td>{{ $data->jumlah }}</td>
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
  $('#table_tipe_dan_status_sekolah').DataTable();
</script>
@endpush