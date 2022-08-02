@extends('layout.dashboard')
@section('title', 'Data Sebaran Calon Mahasiswa')

@section('content')
{{-- data visual --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-4">DATA SEBARAN CALON MAHASISWA</h1>
    <div class="row align-items-end">
      <div class="col-lg-3">
        <form action="{{ route('visual.data.sebaran.calon.mahasiswa') }}" method="GET">
          <div class="mb-3">
            <label for="search_tahun" class="form-label">Tahun</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
              <select class="form-select" id="search_tahun" name="search_tahun">
                <option disabled selected>Pilih</option>
                @foreach ($tahun['semua'] as $loopItem)
                <option value="{{ '20' . $loopItem['tahun'] }}">{{ '20' . $loopItem['tahun'] }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary text-capitalize">filter</button>
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
          <button type="submit" class="btn btn-primary text-capitalize">filter</button>
        </form>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-lg-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">jalur pendaftaran</h1>
            <canvas id="chart_jalur_daftar"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-8 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">program studi dan gender (bar chart)</h1>
            <canvas id="chart_program_studi"></canvas>
          </div>
        </div>
      </div>
      <div class="prodi_all row">
        <h1 class="h5 mb-4 text-center text-uppercase">program studi dan gender (pie chart)</h1>
      </div>
      <div class="col-lg mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">tipe dan status sekolah (SMA & SMK)</h1>
            <canvas id="chart_tipe_dan_status_sekolah_sma_and_smk"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">tipe dan status sekolah (MA & Lain - Lain)</h1>
            <canvas id="chart_tipe_dan_status_sekolah_ma_and_lain_lain"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="h5 text-center text-uppercase">jurusan asal sekolah (SMA)</h1>
              <a href="{{ route('visual.data.jurusan.asal.sekolah.sma') }}"
                class="btn btn-success text-capitalize">Selengkapnya</a>
            </div>
            <canvas id="chart_jurusan_asal_sekolah_sma"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="h5 text-center text-uppercase">jurusan asal sekolah (SMK)</h1>
              <a href="{{ route('visual.data.jurusan.asal.sekolah.smk') }}"
                class="btn btn-success text-capitalize">Selengkapnya</a>
            </div>
            <canvas id="chart_jurusan_asal_sekolah_smk"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="h5 text-center text-uppercase">jurusan asal sekolah (MA)</h1>
              <a href="{{ route('visual.data.jurusan.asal.sekolah.ma') }}"
                class="btn btn-success text-capitalize">Selengkapnya</a>
            </div>
            <canvas id="chart_jurusan_asal_sekolah_ma"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h1 class="h5 text-center text-uppercase">asal kota sekolah</h1>
              <a href="{{ route('visual.data.asal.kota.sekolah') }}"
                class="btn btn-success text-capitalize">Selengkapnya</a>
            </div>
            <canvas id="chart_asal_kota_sekolah"></canvas>
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
      },
      plugins: [ChartDataLabels]
  });

  const dataProgramStudi = {!! json_encode($program_studi) !!};
  new Chart($('#chart_program_studi'), {
    type: 'bar',
    data: {
        labels: dataProgramStudi.semua,
        datasets: [{
            label: 'Laki - Laki',
            data: dataProgramStudi.laki_laki,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          },
          {
            label: 'Perempuan',
            data: dataProgramStudi.perempuan,
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

  const dataTipeDanStatusSekolah = {!! json_encode($tipe_dan_status_sekolah) !!};
  new Chart($('#chart_tipe_dan_status_sekolah_sma_and_smk'), {
    type: 'bar',
    data: {
        labels: ['SMA', 'SMK'],
        datasets: [{
            label: 'Negeri',
            data: [dataTipeDanStatusSekolah.sma.negeri, dataTipeDanStatusSekolah.smk.negeri],
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
            data: [dataTipeDanStatusSekolah.sma.swasta, dataTipeDanStatusSekolah.smk.swasta],
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
  new Chart($('#chart_tipe_dan_status_sekolah_ma_and_lain_lain'), {
    type: 'bar',
    data: {
        labels: ['MA', 'Lain - Lain'],
        datasets: [{
            data: [dataTipeDanStatusSekolah.ma, dataTipeDanStatusSekolah.lain_lain],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 206, 86, 1)'
            ],
            borderWidth: 1
          },]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: false,
            position: 'bottom',
          }
        }
      }
  });

  const dataProdiAll = {!! json_encode($prodi_all) !!};
  dataProdiAll.forEach(function(prodi){
    $('.prodi_all').append(`
      <div class="col-lg-3 mb-4">
        <div class="card h-100">
        {{-- <div class="card h-100" style="border-color: red!important;"> --}}
          <div class="card-body">
            <h1 class="h6 text-center text-uppercase">${prodi.prodi}</h1>
            <canvas id="chart_prodi_${prodi.chart_id}" class="w-100"></canvas>
          </div>
        </div>
      </div>
    `);

    new Chart($(`#chart_prodi_${prodi.chart_id}`), {
      type: 'pie',
      data: {
          labels: ['Laki - Laki', 'Perempuan'],
          datasets: [{
              data: [prodi.laki_laki, prodi.perempuan],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)'
              ],
              borderWidth: 1
            }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              position: 'bottom',
            }
          }
        }
    });
  });

  const dataJurusanAsalSekolah = {!! json_encode($jurusan_asal_sekolah) !!};
  new Chart($('#chart_jurusan_asal_sekolah_sma'), {
    type: 'bar',
    data: {
        labels: dataJurusanAsalSekolah.sma.label,
        datasets: [{
            data: dataJurusanAsalSekolah.sma.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false
          }
        }
      }
  });
  new Chart($('#chart_jurusan_asal_sekolah_ma'), {
    type: 'bar',
    data: {
        labels: dataJurusanAsalSekolah.ma.label,
        datasets: [{
            data: dataJurusanAsalSekolah.ma.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false
          }
        }
      }
  });
  new Chart($('#chart_jurusan_asal_sekolah_smk'), {
    type: 'bar',
    data: {
        labels: dataJurusanAsalSekolah.smk.label,
        datasets: [{
            data: dataJurusanAsalSekolah.smk.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false
          }
        }
      }
  });

  const dataAsalKotaSekolah = {!! json_encode($asal_kota_sekolah) !!};
  console.log(dataAsalKotaSekolah);
  new Chart($('#chart_asal_kota_sekolah'), {
    type: 'bar',
    data: {
        labels: dataAsalKotaSekolah.label,
        datasets: [{
            data: dataAsalKotaSekolah.data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        responsive: true,
        indexAxis: 'y',
        plugins: {
          legend: {
            display: false
          }
        }
      }
  });
</script>
@endpush