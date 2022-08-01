@extends('layout.dashboard')
@section('title', 'Jurusan Asal Sekolah (MA)')

@section('content')
{{-- data visual detail --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-5">JURUSAN ASAL SEKOLAH (MA)</h1>
    <div class="table-responsive">
      <table id="table_jurusan_asal_sekolah_ma" class="table table-striped" style="width:100%">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama Jurusan</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($jurusan_asal_sekolah_ma as $loopItem)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $loopItem->nama_jurusan }}</td>
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
  $('#table_jurusan_asal_sekolah_ma').DataTable();
</script>
@endpush