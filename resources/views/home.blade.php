@extends('layout')
@section('content')
<div id="homepage-slider" class="st-slider">
            <input type="radio" class="cs_anchor radio" name="slider" id="play1" checked="" />
            <input type="radio" class="cs_anchor radio" name="slider" id="slide1" />
            <input type="radio" class="cs_anchor radio" name="slider" id="slide2" />
            <input type="radio" class="cs_anchor radio" name="slider" id="slide3" />
            <div class="images">
                <div class="images-inner">
                    <div class="image-slide">
                        <div class="banner-w3pvt-1">
                            <div class="overlay-wthree"></div>

                        </div>
                    </div>
                    <div class="image-slide">
                        <div class="banner-w3pvt-2">
                            <div class="overlay-wthree"></div>
                        </div>
                    </div>
                    <div class="image-slide">
                        <div class="banner-w3pvt-3">
                            <div class="overlay-wthree"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="labels">
                <div class="fake-radio">
                    <label for="slide1" class="radio-btn"></label>
                    <label for="slide2" class="radio-btn"></label>
                    <label for="slide3" class="radio-btn"></label>
                </div>
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
        </div>
    <section class="about py-5">
        <div class="container py-md-5">
            <div class="about-w3ls-info text-center mx-auto">
                <h3 class="tittle-wthree pt-md-5 pt-3">About Us</h3>
                <p class="sub-tittle mt-3 mb-sm-5 mb-4">Integer pulvinar leo id viverra feugiat. Pellentesque libero ut justo, semper at tempus vel, ultrices in ligula. Lorem ipsum dolor sit amet sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Sed do eiusmod tempor incididunt ut labore et dolore
                    magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                <a href="single.html" class="btn btn-primary submit">Read More</a>
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

                    <p class="mt-4 pr-lg-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse porta erat sit amet eros
                        sagittis, quis
                        hendrerit
                        libero aliquam. Fusce semper augue ac dolor efficitur, a pretium metus pellentesque.</p>
                </div>
                <div class="col-lg-7 welcome-right text-center mt-lg-0 mt-5">
                    <div class="row">

                        <div class="col-sm-4 service-1-w3ls serve-gd2">
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/bengkulu.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Bengkulu</p>
                            </div>
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/LAHAT_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Lahat </p>
                            </div>
                        </div>
                        <div class="col-sm-4 service-1-w3ls serve-gd3">
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/YOGYAKARTA_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Yogyakarta</p>
                            </div>
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/SURABAYA_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="text-li mt-2">Surabaya </p>
                            </div>
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/TANGERANG_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Tangerang </p>
                            </div>
                        </div>
                        <div class="col-sm-4 service-1-w3ls serve-gd2">
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/JAKARTA_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Jakarta </p>
                            </div>
                            <div class="serve-grid mt-4">
                                <span><img src="{{ asset('assets/images/JATENG_ICON.png')}}" style="width:100px;margin-top:30px"></span>
                                <p class="mt-2">Jawa Tengah</p>
                            </div>
                        </div>
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
                <div class="col-md-4 ser-w3pvt-gd-wthree">
                    <div class="icon">
                        {{-- <span><img src="{{ asset('assets/images/MSNew2_8_1.jpg')}}" style="width:100px;margin-bottom:40px"></span> --}}
                    </div>
                    <!-- Icon ends here -->
                    <div class="service-content">
                        <h5>Gemilang Technology</h5>
                        <p class="serp">
                            Quisque sagittis lacus eu lorem sodalesd enean adipiscing.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 ser-w3pvt-gd-wthree">
                    <div class="icon">
                        <span><img src="{{ asset('assets/images/MSNew2_8_1.jpg')}}" style="width:100px;margin-bottom:40px"></span>
                    </div>
                    <!-- Icon ends here -->
                    <div class="service-content">
                        <h5>Microsoft</h5>
                        <p class="serp">
                            Quisque sagittis lacus eu lorem sodalesd enean adipiscing.
                        </p>
                    </div>
                </div>
                <div class="col-md-4 ser-w3pvt-gd-wthree">
                    <div class="icon">
                        <span><img src="{{ asset('assets/images/ppm_mainlogo_only.jpg')}}" style="width:100px;margin-top:20px;margin-bottom:40px"></span>
                    </div>
                    <!-- .Icon ends here -->
                    <div class="service-content">
                        <h5>PPM Manajemen</h5>
                        <p class="serp">
                            Quisque sagittis lacus eu lorem sodalesd enean adipiscing.
                        </p>
                    </div>
                </div>
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
                    <a href="#apply" class="btn btn-default">Berita Kegiatan</a>
                    <a href="contact.html" class="btn btn1"> Agenda Kegiatan </a>
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
                <div class="col-md-6 gal-img">
                    <a href="#gal1"><img src="{{ asset('assets/images/g1.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 gal-img">
                    <a href="#gal2"><img src="{{ asset('assets/images/g2.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 gal-img">
                    <a href="#gal3"><img src="{{ asset('assets/images/g3.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>


                <div class="col-md-3 gal-img ml-auto">
                    <a href="#gal5"><img src="{{ asset('assets/images/g5.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>
                <div class="col-md-3 gal-img mr-auto">
                    <a href="#gal6"><img src="{{ asset('assets/images/g6.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>
                <div class="col-md-6 gal-img">
                    <a href="#gal4"><img src="{{ asset('assets/images/g4.jpg')}}" alt="Gallery Image" class="img-fluid"></a>
                </div>
            </div>


            <!-- gallery popups -->
            <!-- popup-->
            <div id="gal1" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g1.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup -->
            <!-- popup-->
            <div id="gal2" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g2.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup -->
            <!-- popup-->
            <div id="gal3" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g3.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup3 -->
            <!-- popup-->
            <div id="gal4" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g4.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup -->
            <!-- popup-->
            <div id="gal5" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g5.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup -->
            <!-- popup-->
            <div id="gal6" class="pop-overlay animate">
                <div class="popup">
                    <img src="{{ asset('assets/images/g6.jpg')}}" alt="Popup Image" class="img-fluid" />
                    <p class="mt-4">Nulla viverra pharetra se, eget pulvinar neque pharetra ac int. placerat placerat
                        dolor.</p>
                    <a class="close" href="#gallery">&times;</a>
                </div>
            </div>
            <!-- //popup -->
            <!-- //gallery popups -->
        </div>
    </div>
    <!-- //gallery -->
    @endsection
