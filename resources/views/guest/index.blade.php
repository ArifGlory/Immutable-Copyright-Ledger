@extends('layouts.guest')

@section('title', 'Info Layanan')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{asset('assets/img/IopT13l2bZwuCHsVdqtmGFke3qNe8MKM6U67sanu.webp')}}" class="navbar-brand-img w-25 rounded-circle" alt="...">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard">Dashboard</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>Giga Asset</h1>
          <p class="lead">Manajemen Asset TIK</p>
          <a href="/dashboard" class="btn btn-primary btn-lg">Get Started</a>
        </div>
        <div class="col-md-6">
          <!-- <img src="hero-image.jpg" alt="Hero Image" class="img-fluid"> -->
        </div>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row">
        @foreach($info as $item)
        <a href="{{route('info.show',$item->layanan_slug)}}" class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                {{$item->layanan_nama}}
              </h5>
              <p class="card-text">
                {{$item->layanan_desc}}
              </p>
            </div>
          </div>
        </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto text-center">
          <h2>Giga Asset</h2>
          <p class="lead">Aset TIK Terkelola dengan Tepat dan Aman.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-3 bg-dark text-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p>&copy; 2024 Bidang TIK, Diskominfotik Prov. Lampung</p>
        </div>
        <div class="col-md-6 text-end">
          <a target="_blank" href="https://diskominfotik.lampungprov.go.id" class="text-light">Diskominfotik</a>
          <span class="text-muted mx-2">|</span>
          <a target="_blank" href="https://layanantik.lampungprov.go.id/" class="text-light">ULTI - Layanan TIK</a>
        </div>
      </div>
    </div>
  </footer>
</main>
@endsection
