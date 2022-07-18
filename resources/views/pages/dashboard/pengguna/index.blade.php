@extends('layout.dashboard')
@section('title', 'Pengguna')

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
        <tbody></tbody>
      </table>
    </div>
  </div>
</section>
{{-- pengguna --}}
@endsection

@push('script')
<script>
  const DATATABLES_URL_AJAX = "{{ route('pengguna.datatables') }}";
  $('#table_pengguna').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: DATATABLES_URL_AJAX,
    columns: [
      {
        data: 'DT_RowIndex',
        orderable: false,
        searchable: false
      },
      {
        data: 'nama_pengguna'
      },
      {
        data: 'email_pengguna'
      },
      {
        data: 'jabatan_pengguna'
      },
      {
        data: 'id_pengguna',
        render: function(data){
          let UPDATE_TRUCK_URL = "{{ route('pengguna.update.view', ':id') }}";
          let DELETE_TRUCK_URL = "{{ route('pengguna.delete.action', ':id') }}";
          
          UPDATE_TRUCK_URL = UPDATE_TRUCK_URL.replace(':id', data);
          DELETE_TRUCK_URL = DELETE_TRUCK_URL.replace(':id', data);

          return `
            <a class="btn btn-success btn-sm text-capitalize" href="${UPDATE_TRUCK_URL}">ubah</a>
            <a class="btn btn-danger btn-sm text-capitalize mx-2 delete_truck" href="${DELETE_TRUCK_URL}">hapus</a>
          `;
        }
      }
    ],
    initComplete: function(settings, json) {
      $('.btn-danger').each(function(index){
          $(this).on('click', function(event){
            const question = confirm('apakah anda yakin menghapus data ini?');
            
            if(question){
              return;
            }else{
              event.preventDefault();
            }
          });
      });
    },
  });
</script>
@endpush