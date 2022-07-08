@extends('layout.dashboard')

@section('content')
{{-- data visual --}}
<section>
  <div class="container my-4">
    <h1 class="h4">Data Calon Mahasiswa</h1>
    <div class="row">
      <div class="col-lg-3">
        <div class="mb-3">
          <label for="search_tahun" class="form-label">Tahun</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input type="text" class="form-control" id="search_tahun" name="search_tahun" placeholder="masukkan tahun">
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="mb-3">
          <label for="tahun_awal" class="form-label">Tahun Awal</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
            <input type="text" class="form-control date" id="tahun_awal" name="tahun_awal"
              placeholder="masukkan tahun awal">
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="mb-3">
          <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
            <input type="text" class="form-control date" id="tahun_akhir" name="tahun_akhir"
              placeholder="masukkan tahun akhir">
          </div>
        </div>
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
            <h1 class="h5 text-center text-uppercase">registrasi berkas</h1>
            <canvas id="chart_registrasi_berkas"></canvas>
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
  $('.date').datepicker({
      changeMonth: false,
      changeYear: true,
      showButtonPanel: true,
      dateFormat: 'yy',
      // onClose: function(dateText, inst) { 
      //     const year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
      //     $(this).datepicker('setDate', new Date(year, 1));
      // }
  });

  const centerPoint = {
    id: 'center_point',
    afterDraw(chart, args, options){
      const { ctx, chartArea: { left, right, top, bottom, width, height } } = chart;
      ctx.save();

      if(chart._active.length > 0){
        const point = chart.config.data.datasets[chart._active[0].datasetIndex].data[chart._active[0].index];

        ctx.font = 'bolder 4rem Arial';
        ctx.fillStyle = 'black';
        ctx.textAlign = 'center';
        ctx.fillText(`${point}%`, (width / 2), (height / 2 + top));
      }
    }
  }

  new Chart($('#chart_unggah_berkas'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });

  new Chart($('#chart_verifikasi_berkas'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });

  new Chart($('#chart_registrasi_berkas'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });

  new Chart($('#chart_registrasi_ulang'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });

  new Chart($('#chart_memiliki_nim'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });

  new Chart($('#chart_mengundurkan_diri'), {
    type: 'pie',
    data: {
        labels: ['Sudah', 'Belum'],
        datasets: [{
            data: [12, 19],
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
            position: 'bottom',
          }
        }
      },
      plugins: [centerPoint]
  });
</script>
@endpush