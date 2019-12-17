@extends('layout')
@section('content')

   <div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <?php $i = 0; ?>
    @foreach($sliders as $slide)
    @if($i == 0)
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    @else
    <li data-target="#demo" data-slide-to="{{$i}}"></li>
    @endif
    <?php $i++; ?>
    @endforeach
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    <?php $i = 0; ?>
    @foreach($sliders as $slide)
    @if($i == 0)
    <div class="carousel-item active">
      <div class="banner-w3pvt" style="background: url({{ '../../images/posts/' .$slide->file_name }}) no-repeat;background-size: cover;height: 750px;">
                    <div class="overlay-wthree"></div>

                </div>
    </div>
    @else
    <div class="carousel-item">
      <div class="banner-w3pvt" style="background: url({{ '../../images/posts/' .$slide->file_name }}) no-repeat;background-size: cover;height: 750px;">
                    <div class="overlay-wthree"></div>

                </div>
    </div>
    @endif
    <?php $i++; ?>
    @endforeach
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
    <!-- banner-w3ls-info -->
            <!--
            <div class="banner-w3ls-info">
                <div class="content-bg-1 one-bg">
                    <span class="fa fa-lightbulb-o" aria-hidden="true"></span>
                    <h3 class="ban-text">
                        Computer Based Exam
                    </h3>
                </div>
                <div class="content-bg-1 two-bg">
                    <span class="fa fa-book"></span>
                    <h3 class="ban-text">
                        Penerimaan Siswa baru
                    </h3>
                </div>
                <div class="content-bg-1 third-bg">
                    <span class="fa fa-shield" aria-hidden="true"></span>
                    <h3 class="ban-text">
                        Certification Awarded
                    </h3>
                </div>
            </div>
        -->
        <!-- //banner-w3ls-info -->
    <section class="about py-5">
        <div class="container py-md-5">
            <div class="about-w3ls-info text-center mx-auto">
                @if($sejarah != null)
                <h3 class="tittle-wthree pt-md-5 pt-3">{{$sejarah['title']}}</h3>
                <p class="sub-tittle mt-3 mb-sm-5 mb-4">{!!$sejarah['headline']!!}</p>
                <a href="{{route('page', $sejarah['categories_slug'])}}" class="btn btn-primary submit">Read More</a>
                @endif
            </div>
        </div>
    </section>
    <!-- //about -->
    <!-- /features -->
    <div class="welcome py-5" id="features">
        <div class="container py-xl-5 py-lg-3">
            <div class="row">
                <div class="col-lg-5 welcome-left">
                    {{-- <p>What We Provide</p> --}}
                    <h3 class="tittle-wthree mt-2 mb-3">Daftar Unit</h3>

                  <!--   <p class="mt-4 pr-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porta erat sit amet eros
                        sagittis, quis
                        hendrerit
                    libero aliquam. Fusce semper augue ac dolor efficitur, a pretium metus pellentesque.</p> -->
                </div>
                <div class="col-lg-7 welcome-right text-center mt-lg-0 mt-5">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($regions as $region)
                        <?php 
                            if($i > 7){
                                $i = 1;
                            }
                         ?>
                            @if($i / 1 == 1)
                        <div class="col-sm-4 service-1-w3ls serve-gd2">
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icons/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}}</p>
                                </a>
                            </div>
                            @endif
                             @if($i / 2 == 1)
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icons/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}} </p>
                                </a>
                            </div>
                        </div>
                            @endif
                             @if($i / 3 == 1)
                        <div class="col-sm-4 service-1-w3ls serve-gd3">
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icons/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}}</p>
                            </a>
                            </div>
                            @endif

                             @if($i / 4 == 1)
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icons/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="text-li mt-2">{{$region->region_name}} </p>
                            </a>
                            </div>
                            @endif
                             @if($i / 5 == 1)
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icons/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}} </p>
                            </a>
                            </div>
                        </div>
                            @endif
                        
                             @if($i / 6 == 1)
                        <div class="col-sm-4 service-1-w3ls serve-gd2">
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icon/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}} </p>
                            </a>
                            </div>
                            @endif
                             @if($i / 7 == 1)
                            <div class="serve-grid mt-4">
                                <a href="http://{{$region->url}}">
                                <span><img src="{{ asset('/images/icon/'.$region->icon)}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">{{$region->region_name}}</p>
                            </a>
                            </div>
                        </div>
                            @endif
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //features -->

    <!-- services -->
    <section class="services text-center py-5" id="services">
        <div class="container py-md-5">
            <h3 class="tittle-wthree text-center">Partners</h3>

            <div class="row ser-sec-1">
                @foreach($partners as $partner)
                <div class="col-md-4 ser-w3pvt-gd-wthree">
                   
                        <span>
                            @foreach($photo_partners as $photo_partner)
                            @if($photo_partner->post_id == $partner->posts_id)
                            <img src="{{ asset('/images/posts/'.$photo_partner->file_name)}}" style="width:200px;margin-bottom:20px">
                            <?php break; ?>
                            @endif
                            @endforeach
                        </span>
                    <!-- Icon ends here -->
                    <div class="service-content">
                        <h5>{{$partner->title}}</h5>
                        <p class="serp">
                            {!!$partner->headline!!}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
<!-- //services -->
<!--/mid-content-->
<section class="last-content py-5" style="background-color: #ffff99">
    <div class="container py-md-3 text-center">
        <div class="last-lavi-inner-content px-lg-5">
            <h3 class="mb-4 tittle-wthree">Event</h3>
            <p class="px-lg-5" style="color:#555">Follow Update Event Terbaru dari Tarakanita</p>
            <div class="buttons mt-md-4 mt-3">
                <a href="{{route('lists', 'berita-kegiatan')}}" class="btn btn-default">Berita Kegiatan</a>
                <a href="{{route('lists', 'agenda-kegiatan')}}" class="btn btn1"> Agenda Kegiatan </a>
            </div>
        </div>
    </div>
</section>
<!--//mid-content-->

<!-- gallery -->
<div class="gallery py-5 text-center" id="gallery">
    <div class="container py-md-5">
        <h3 class="tittle-wthree text-center">Our Gallery</h3>
        <p class="sub-tittle text-center mt-3 mb-sm-5 mb-4">Sed do eiusmod tempor incididunt ut labore et
            dolore
            magna
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
        <div class="row no-gutters">
            <?php $count = 1; ?>
            @foreach($galleries as $gallery)
            @if($count/1 == 1)
            <div class="col-md-6 gal-img">
                <a href="#gal1"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            @if($count/2 == 1)
            <div class="col-md-3 gal-img">
                <a href="#gal2"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            @if($count/3 == 1)
            <div class="col-md-3 gal-img">
                <a href="#gal3"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            @if($count/4 == 1)

            <div class="col-md-3 gal-img ml-auto">
                <a href="#gal5"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            @if($count/5 == 1)
            <div class="col-md-3 gal-img mr-auto">
                <a href="#gal6"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            @if($count/6 == 1)
            <div class="col-md-6 gal-img">
                <a href="#gal4"><img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Gallery Image" class="img-fluid"></a>
            </div>
            @endif
            <?php $count++; ?>
            @endforeach
        </div>

        <?php $i = 1; ?>
        @foreach($galleries as $gallery)
        <div id="gal{{$i}}" class="pop-overlay animate">
            <div class="popup">
                <h3>{{$gallery->title}}</h3>
                <img src="{{ asset('/images/posts/'.$gallery->file_name)}}" alt="Popup Image" class="img-fluid" />
                <p class="mt-4">{{$gallery->headline}}</p>
                <a class="close" href="#gallery">&times;</a>
            </div>
        </div>
        <?php $i++; ?>
        @endforeach
        <!-- //popup -->
        <!-- //gallery popups -->
    </div>
</div>
<!-- //gallery -->
@endsection
