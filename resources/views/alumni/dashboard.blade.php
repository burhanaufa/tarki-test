@extends('alumni.templates.layout')
@section('content')
<!-- Masthead -->
<header class="masthead bg-primary text-center">
    <div class="container d-flex align-items-center flex-column">

      <!-- Masthead Avatar Image -->
      @if($foto=="")
          <img class="masthead-avatar mb-5" src="{{ asset('assets/alumni/img/no_foto.png') }}" alt="">
      @else
          <img class="masthead-avatar mb-5" src="data:image/gif;base64,{{ $foto }}" alt="">
      @endif

      <!-- Masthead Heading -->
      <h1 class="masthead-heading mb-0">{{ $nama }}</h1>

      <!-- Icon Divider -->
      <div class="divider-custom divider-light">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-line"></div>
      </div>

      <!-- Masthead Subheading -->
      <p class="masthead-subheading font-weight-light mb-0">{{ $departement }} | {{ $angkatan }}</p>

    </div>
  </header>
  

  <!-- Contact Section -->
  <section class="page-section" id="contact">
    <div class="container">

      <!-- Contact Section Heading -->
      <h2 class="page-section-heading text-center text-secondary mb-0">Alumni Detail</h2>

      <!-- Icon Divider -->
      <div class="divider-custom">
        <div class="divider-custom-line"></div>
        <div class="divider-custom-line"></div>
      </div>

      <!-- Contact Section Form -->
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
          <table class="table">
                <tr class="info">
                    <td width="40%"><b>Kelas</b></td>
                    <td width="5%">:</td>
                    <td><b>{{ $kelas }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>Alamat</b></td>
                    <td>:</td>
                    <td><b>{{ $alamat }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>Tanggal Lahir</b></td>
                    <td>:</td>
                    <td><b>{{ $tanggal_lahir }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>No Telpon</b></td>
                    <td>:</td>
                    <td><b>{{ $no_telpon }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>No Hp</b></td>
                    <td>:</td>
                    <td><b>{{ $hp }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>Email</b></td>
                    <td>:</td>
                    <td><b>{{ $email }}</b></td>
                </tr>
                <tr class="info">
                    <td><b>Hobi</b></td>
                    <td>:</td>
                    <td><b>{{ $hobi }}</b></td>
                </tr>
          </table>
        </div>
      </div>

    </div>
</section>
@endsection('content')