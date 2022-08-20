@extends('layout.dashboard')
@section('title', 'Laporan')

@section('content')
{{-- data laporan --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-4">LAPORAN</h1>
    <form action="{{ route('laporan.pdf') }}" method="GET">
      <div class="row align-items-end">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg">
              <div class="mb-3">
                <label for="search_data" class="form-label">Data Visualisasi</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                  <select class="form-select" id="search_data" name="search_data">
                    <option disabled selected>Pilih</option>
                    <option value="data_calon_mahasiswa">Data Calon Mahasiswa</option>
                    <option value="data_sebaran_calon_mahasiswa">Data Sebaran Calon Mahasiswa</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="tahun_awal" class="form-label">Tahun Awal</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                  <select class="form-select" id="tahun_awal" name="tahun_awal">
                    <option disabled selected>Pilih</option>
                    @foreach ($tahun['semua'] as $loopItem)
                    <option value="{{ '20' . $loopItem['tahun'] }}">{{ '20' . $loopItem['tahun'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="mb-3">
                <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                  <select class="form-select" id="tahun_akhir" name="tahun_akhir">
                    <option disabled selected>Pilih</option>
                    @foreach ($tahun['semua'] as $loopItem)
                    <option value="{{ '20' . $loopItem['tahun'] }}">{{ '20' . $loopItem['tahun'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary text-capitalize">Unduh Laporan</button>
        </div>
      </div>
    </form>
  </div>
</section>
{{-- data laporan --}}
@endsection

@push('script')
<script>
  const tahun = {!! json_encode($tahun) !!};
  console.log(tahun);
  $('.date').datepicker({
      changeMonth: false,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'yy',
      yearRange: `${tahun.pertama}:${tahun.akhir}`,
      onClose: function(data){
        function isDonePressed() {
          return ($('#ui-datepicker-div').html().indexOf('ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all ui-state-hover') > -1);
        }
        if (isDonePressed()){
          const year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).datepicker('setDate', new Date(year, 1));
        }
      }
  });
</script>
@endpush