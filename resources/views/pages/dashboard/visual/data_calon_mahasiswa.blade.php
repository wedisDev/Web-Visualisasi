@extends('layout.dashboard')
@section('title', 'Data Calon Mahasiswa')

@section('content')
{{-- data visual --}}
<section>
  <div class="container my-4">
    <h1 class="h4 mb-4">DATA CALON MAHASISWA</h1>
    <div class="row align-items-end">
      <div class="col-lg-12 mb-4">
        <div class="row">
          <div class="col-lg-3">
            <form action="" method="GET">
              <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                  <input type="date" class="form-control" name="tanggal" id="tanggal">
                </div>
              </div>
              <button type="submit" class="btn btn-primary text-capitalize">filter</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <form action="{{ route('visual.data.calon.mahasiswa') }}" method="GET">
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
      <div class="col-lg-1 align-self-center">
        <h1 class="h5">atau</h1>
      </div>
      <div class="col-lg-6">
        <form action="{{ route('visual.data.calon.mahasiswa') }}" method="GET">
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
    <div class="d-flex justify-content-between align-items-center mt-4">
      <h1 class="h5">Total Daftar: 286 Mahasiswa</h1>
      <h1 class="h5">Informasi Calon Mahasiswa: 20 Oktober 2022</h1>
    </div>
    <div class="row mt-4">
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>1.</h5>
              <h1 class="h5 text-center text-uppercase">unggah berkas</h1>
            </div>
            <canvas id="chart_unggah_berkas"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">total pendaftar: {{ $total_pendaftar }} mahasiswa</small>
              <small class="text-muted text-capitalize">
                sudah unggah berkas: {{ $data['unggah_berkas']['sudah'] }} mahasiswa
              </small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>2.</h5>
              <h1 class="h5 text-center text-uppercase">verifikasi berkas</h1>
            </div>
            <canvas id="chart_verifikasi_berkas"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">
                sudah unggah berkas: {{ $data['unggah_berkas']['sudah'] }} mahasiswa
              </small>
              <small class="text-muted text-capitalize">
                sudah verifikasi berkas: {{ $data['verifikasi_berkas']['sudah'] }} mahasiswa
              </small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>3.</h5>
              <h1 class="h5 text-center text-uppercase">membayar registrasi</h1>
            </div>
            <canvas id="chart_membayar_registrasi"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">
                sudah verifikasi berkas: {{ $data['verifikasi_berkas']['sudah'] }} mahasiswa
              </small>
              <small class="text-muted text-capitalize">
                sudah membayar registrasi: {{ $data['membayar_registrasi']['sudah'] }} mahasiswa
              </small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>4.</h5>
              <h1 class="h5 text-center text-uppercase">registrasi ulang</h1>
            </div>
            <canvas id="chart_registrasi_ulang"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">
                sudah membayar registrasi: {{ $data['membayar_registrasi']['sudah'] }} mahasiswa
              </small>
              <small class="text-muted text-capitalize">
                sudah registrasi ulang: {{ $data['registrasi_ulang']['sudah'] }} mahasiswa
              </small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>5.</h5>
              <h1 class="h5 text-center text-uppercase">memiliki nim</h1>
            </div>
            <canvas id="chart_memiliki_nim"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">
                sudah registrasi ulang: {{ $data['membayar_registrasi']['sudah'] }} mahasiswa
              </small>
              <small class="text-muted text-capitalize">
                sudah memiliki nim: {{ $data['memiliki_nim']['sudah'] }} mahasiswa
              </small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h5>6.</h5>
              <h1 class="h5 text-center text-uppercase">mengundurkan diri</h1>
            </div>
            <canvas id="chart_mengundurkan_diri"></canvas>
            <div class="d-flex flex-column align-items-center mt-2">
              <small class="text-muted text-capitalize">
                sudah memiliki nim: {{ $data['memiliki_nim']['sudah'] }} mahasiswa
              </small>
              <small class="text-muted text-capitalize">
                sudah mengundurkan diri: {{ $data['mengundurkan_diri']['sudah'] }} mahasiswa
              </small>
            </div>
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
  const chartsData = {!! json_encode($data) !!};
  const centerPoint = {
    id: 'center_point',
    afterDraw(chart, args, options){
      const { ctx, chartArea: { left, right, top, bottom, width, height } } = chart;
      ctx.save();

      // const point = chart.config.data.datasets[0].data[0];
      const point = chartsData[chart.$context.chart.canvas.id.replace('chart_', '')]?.percent;
      ctx.font = 'bolder 3rem Arial';
      ctx.fillStyle = 'black';
      ctx.textAlign = 'center';
      ctx.fillText(`${point ?? ''}%`, (width / 2), (height / 2 + top));
      
      // if(chart._active.length > 0){
      //   const point = chart.config.data.datasets[chart._active[0].datasetIndex].data[chart._active[0].index];
      //   ctx.fillText(`${point}%`, (width / 2), (height / 2 + top));
      // }
    }
  }
  
  const charts = document.querySelectorAll('canvas');
  
  Array.from(charts).forEach(function(element){
    const chartData = chartsData[element.id.replace('chart_', '')];

    new Chart($(`#${element.id}`), {
      type: 'pie',
      data: {
          labels: ['Sudah', 'Belum'],
          datasets: [{
              data: [chartData?.sudah, chartData?.belum],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)'
              ],
              borderWidth: 1,
              cutout: '60%'
            }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom'
            }
          },
          onClick: function(event, item) {
            const status = ['sudah', 'belum'];
            const indexChart = item[0].element.$context.dataIndex;
            const chartName = element.id.replace('chart_', '').replace('_', ' ');

            const REQUEST_URL = "{{ route('visual.data.calon.mahasiswa.detail.chart', [':status', ':chart']) }}".replace(':status', status[indexChart]).replace(':chart', chartName);

            window.open(REQUEST_URL, '_newtab');
          }
        },
        plugins: [centerPoint]
    });
  });
</script>
@endpush