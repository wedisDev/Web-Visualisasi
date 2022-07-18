@extends('layout.dashboard')
@section('title', 'Data Sebaran Calon Mahasiswa')

@section('content')
{{-- data visual --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Data Sebaran Calon Mahasiswa</h1>
    <div class="row align-items-end">
      <div class="col-lg-3">
        <form action="{{ route('visual.data.sebaran.calon.mahasiswa') }}" method="GET">
          <div class="mb-3">
            <label for="search_tahun" class="form-label">Tahun</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
              <select class="form-select" id="search_tahun" name="search_tahun">
                @foreach ($tahun['semua'] as $loopItem)
                <option value="{{ '20' . $loopItem['tahun'] }}">{{ '20' . $loopItem['tahun'] }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-light text-capitalize">filter</button>
        </form>
      </div>
      <div class="col-lg-6">
        <form action="{{ route('visual.data.sebaran.calon.mahasiswa') }}" method="GET">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="tahun_awal" class="form-label">Tahun Awal</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                  <select class="form-select" id="tahun_awal" name="tahun_awal">
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
                    @foreach ($tahun['semua'] as $loopItem)
                    <option value="{{ '20' . $loopItem['tahun'] }}">{{ '20' . $loopItem['tahun'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-light text-capitalize">filter</button>
        </form>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">jalur daftar</h1>
            <canvas id="chart_jalur_daftar"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-8 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">program studi</h1>
            <canvas id="chart_program_studi"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">tipe dan status sekolah</h1>
            <canvas id="chart_tipe_dan_status_sekolah"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">kota / kabupaten</h1>
            <canvas id="chart_kota_atau_kabupaten"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">jurusan</h1>
            <canvas id="chart_memiliki_nim"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- data visual --}}
@endsection

@push('script')
<script>
  const tahun = {!! json_encode($tahun) !!};
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

  const dataJalurDaftar = {!! json_encode($jalur_daftar) !!};
  new Chart($('#chart_jalur_daftar'), {
    type: 'pie',
    data: {
        labels: dataJalurDaftar.map(data => data.nama_jalur),
        datasets: [{
            data: dataJalurDaftar.map(data => data.count),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          }
        }
      }
  });

  const dataProgramStudi = {!! json_encode($program_studi) !!};
  console.log(dataProgramStudi);
  new Chart($('#chart_program_studi'), {
    type: 'bar',
    data: {
        labels: dataProgramStudi.semua,
        datasets: [{
            label: 'Perempuan',
            data: dataProgramStudi.perempuan,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          },
          {
            label: 'Laki - Laki',
            data: dataProgramStudi.laki_laki,
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
          legend: {
            position: 'bottom',
          }
        }
      }
  });

  new Chart($('#chart_tipe_dan_status_sekolah'), {
    type: 'bar',
    data: {
        labels: ['SMA', 'SMK'],
        datasets: [{
            label: 'Negri',
            data: [12, 19],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          },
          {
            label: 'Swasta',
            data: [3, 5],
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          }
        }
      }
  });
</script>
@endpush