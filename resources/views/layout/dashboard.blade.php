<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <style>
    .ui-datepicker-calendar {
      display: none;
    }

    .ui-datepicker-month {
      display: none;
    }

    .ui-datepicker-prev {
      display: none;
    }

    .ui-datepicker-next {
      display: none;
    }
  </style>
</head>

<body>

  {{-- header --}}
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand" href="{{ route('dashboard.index') }}">
        <img src="{{ asset('assets/images/logo-undika.png') }}" alt="logo undika" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index') }}">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Visualisasi
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('visual.data.calon.mahasiswa') }}">Data Calon Mahasiswa</a>
              </li>
              <li><a class="dropdown-item" href="{{ route('visual.data.sebaran.calon.mahasiswa') }}">Data Sebaran Calon
                  Mahasiswa</a></li>
            </ul>
          </li>
          @if (auth('pengguna')->user()->jabatan_pengguna == 'staf')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pengguna.index') }}">Pengguna</a>
          </li>
          @endif
          @if (auth('pengguna')->user()->jabatan_pengguna == 'kabag')
          <li class="nav-item">
            <a class="nav-link" href="#">Laporan</a>
          </li>
          @endif
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ auth('pengguna')->user()->nama_pengguna }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{ route('auth.logout.action') }}">Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  {{-- header --}}

  @yield('content')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
  </script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"
    integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('script')
</body>

</html>