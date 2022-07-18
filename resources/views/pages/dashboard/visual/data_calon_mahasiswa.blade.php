@extends('layout.dashboard')
@section('title', 'Data Calon Mahasiswa')

@section('content')
{{-- data visual --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Data Calon Mahasiswa</h1>
    <div class="row align-items-end">
      <div class="col-lg-3">
        <form action="{{ route('visual.data.calon.mahasiswa') }}" method="GET">
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
        <form action="{{ route('visual.data.calon.mahasiswa') }}" method="GET">
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
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">unggah berkas</h1>
            <canvas id="chart_unggah_berkas"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">verifikasi berkas</h1>
            <canvas id="chart_verifikasi_berkas"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">membayar registrasi</h1>
            <canvas id="chart_membayar_registrasi"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">registrasi ulang</h1>
            <canvas id="chart_registrasi_ulang"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">memiliki nim</h1>
            <canvas id="chart_memiliki_nim"></canvas>
          </div>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h1 class="h5 text-center text-uppercase">mengundurkan diri</h1>
            <canvas id="chart_mengundurkan_diri"></canvas>
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

  const centerPoint = {
    id: 'center_point',
    afterDraw(chart, args, options){
      const { ctx, chartArea: { left, right, top, bottom, width, height } } = chart;
      ctx.save();

      const point = chart.config.data.datasets[0].data[0];
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

  const chartsData = {!! json_encode($data) !!};
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
          }
        },
        plugins: [centerPoint]
    });
  });
</script>
@endpush