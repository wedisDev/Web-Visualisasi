@extends('layout.dashboard')
@section('title', 'Beranda')

@section('content')
{{-- hero --}}
<section class="hero_section">
  {{-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
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
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div> --}}
</section>
{{-- hero --}}

{{-- visualisasi --}}
<section>
  <div class="container my-5">
    <h1 class="h4 text-center mb-4">VISUALISASI INFORMASI</h1>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-lg mb-4">
            <a href="{{ route('visual.data.calon.mahasiswa') }}" class="text-decoration-none">
              <div class="card bg-light">
                <div class="card-body card_visual">
                  <div class="icon">
                    <i class="fa-solid fa-pie-chart"></i>
                  </div>
                  <h1 class="h5">Data Calon Mahasiswa</h1>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg mb-4">
            <a href="{{ route('visual.data.sebaran.calon.mahasiswa') }}" class="text-decoration-none">
              <div class="card bg-light">
                <div class="card-body card_visual">
                  <div class="icon">
                    <i class="fa-solid fa-bar-chart"></i>
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
@endsection