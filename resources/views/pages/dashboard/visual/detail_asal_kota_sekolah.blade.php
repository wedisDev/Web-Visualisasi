@extends('layout.dashboard')
@section('title', 'Asal Kota Sekolah')

@section('content')
{{-- data visual detail --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Asal Kota Sekolah</h1>
    <div class="table-responsive">
      <table id="table_asal_kota_sekolah" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Kota</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($asal_kota_sekolah as $loopItem)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $loopItem->nama_kota }}</td>
            <td>{{ $loopItem->count }}</td>
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
  $('#table_asal_kota_sekolah').DataTable();
</script>
@endpush