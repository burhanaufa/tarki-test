@extends('alumni.templates.layout')
@section('content')
<!-- Masthead -->
<header class="masthead bg-primary text-center">
    <div class="container d-flex align-items-center flex-column">

        <!-- Masthead Heading -->
        <h1 class="masthead-heading mb-0">Search Alumni</h1>

        <!-- Icon Divider -->
        <div class="divider-custom divider-light">
          <div class="divider-custom-line"></div>
          <div class="divider-custom-line"></div>
        </div>
  
        <!-- Masthead Subheading -->
        <p class="masthead-subheading font-weight-light mb-0">{{ $departement }}</p>

    </div>
  </header>
  

  <!-- Contact Section -->
  <section class="page-section portfolio" id="portfolio">
      <p class="text-uppercase" style="text-align:center;font-family:Verdana, Geneva, Tahoma, sans-serif;font-weight: bold;font-size: 2rem">
          {{$kelas}} | {{$angkatan}}
      </p>
      <div class="container">
        <div class="row">
          <!-- Portfolio Item 1 -->
          @foreach($search -> data_alumni as $item)
          <div class="col-md-6 col-lg-4">
            <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
            <a href="/alumni/detail_alumni/{{ $item->nis }}" target="_BLANK">
                @if($item->foto=="")
                  <center><img class="img-fluid" src="{{ asset('assets/alumni/img/no_foto.png') }}" alt="" width="200px"></center>
                @else
                  <center><img class="img-fluid" src="data:image/gif;base64,{{$item->foto}}" alt="" width="200px"></center>
                @endif
                <p style="text-align:center;font-family:Verdana, Geneva, Tahoma, sans-serif;font-weight: bold;font-size: 2rem">
                  {{$item->nama}}
                </p>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
</section>

 <!-- Portfolio Modals -->
@endsection('content')