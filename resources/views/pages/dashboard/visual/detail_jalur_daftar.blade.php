@extends('layout.dashboard')
@section('title', 'Jalur Daftar' .' '. $jalurDaftar->nama_jalur)

@section('content')
{{-- data visual detail --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-5 text-uppercase">Jalur Daftar ({{ $jalurDaftar->nama_jalur }})</h1>
    <div class="table-responsive">
      <table id="table_detail_jalur_daftar" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>Prodi</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($chartData as $data)
          <tr>
            <td>{{ $data->nama_prodi }}</td>
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
  $('#table_detail_jalur_daftar').DataTable();
</script>
@endpush