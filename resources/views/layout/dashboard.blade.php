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
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>

<body>

  {{-- header --}}
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container d-flex justify-content-between">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/images/logo-undika.png') }}" alt="logo undika" height="50px">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Visualisasi
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Data Calon Mahasiswa</a></li>
              <li><a class="dropdown-item" href="#">Data Sebaran Calon Mahasiswa</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pengguna</a>
          </li>
        </ul>
      </div>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              User
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  {{-- header --}}

  {{-- carousel --}}
  <section>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('assets/images/carousel/slide-1.jpg') }}" class="d-block w-100" alt="carousel slide 1">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('assets/images/carousel/slide-2.jpg') }}" class="d-block w-100" alt="carousel slide 2">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('assets/images/carousel/slide-3.jpg') }}" class="d-block w-100" alt="carousel slide 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>
  {{-- carousel --}}

  {{-- visualisasi --}}
  <section>
    <div class="container my-5">
      <h1 class="h4 text-center mb-4">Visualisasi Informasi</h1>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg mb-4">
              <a href="#" class="text-decoration-none">
                <div class="card bg-light">
                  <div class="card-body card_visual">
                    <div class="icon">
                      <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <h1 class="h5">Data Calon Mahasiswa</h1>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg mb-4">
              <a href="#" class="text-decoration-none">
                <div class="card bg-light">
                  <div class="card-body card_visual">
                    <div class="icon">
                      <i class="fa-solid fa-diagram-project"></i>
                    </div>
                    <h1 class="h5">Data Sebaran Calon Mahasiswa</h1>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- visualisasi --}}

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
</body>

</html>