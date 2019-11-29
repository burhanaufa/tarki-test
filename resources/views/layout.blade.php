
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tarakanita</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Tarakanita Web" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <!-- //Meta tag Keywords -->
    <!-- Custom-Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i,900,900i" rel="stylesheet">
    <!-- //Fonts -->
</head>

<body>
    <!-- home -->
    <div id="home">
        <!-- banner -->
        <div class="top_w3pvt_main container">

            <!-- nav -->
            <div class="nav_w3pvt text-center ">
                <!-- nav -->
                <nav class="lavi-wthree">
                    <div id="logo">
                        <h4> <a class="navbar-brand" href="index.html">Tarakanita</a>
                        </h4>
                    </div>

                    <ul class="menu mr-auto">
                        <?php $i = 0; $j=0; ?>
                        <li class="active"><a href="#">Home</a></li>
                        @if($top_menu_parent != null)
                        @foreach($top_menu_parent as $item)
                        {{-- <li><a href="about.html"></a></li> --}}
                        @foreach ($sub_menu_parent as $item2)
                            @if($item->id == $item2->parent)
                            <?php $i = 1; break;?>
                            @endif
                        @endforeach
                        @if($i == 1)
                        <li>

                            <a href="#">{{$item->category_name}} <span class="fa fa-angle-down" aria-hidden="true"></span></a>

                            <ul>
                                @foreach ($sub_menu_parent as $item2)
                                @if($item->id == $item2->parent)
                                <li>
                                    @if($item2->category_view == 0)
                                    <a href="{{route('lists', $item2['slug'])}}">{{$item2->category_name}}</a>
                                    @else
                                    <a href="{{route('page', $item2['slug'])}}">{{$item2->category_name}}</a>
                                    @endif
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        @else
                        <li>
                                @if($item->category_view == 0)
                                <a href="{{route('lists', $item['slug'])}}">{{$item->category_name}}</a>
                                @else
                                <a href="{{route('page', $item['slug'])}}">{{$item->category_name}}</a>
                                @endif
                        </li>
                        @endif
                        <?php $i = 0;$j++; ?>
                        @endforeach
                        @endif
                        <li class="log-vj ml-lg-5"><a href="{{route('alumni')}}"><span class="fa fa-user-circle-o" aria-hidden="true"></span> Portal Alumni</a>
                        <li><a href="#"><img src="{{ asset('assets/images/LOGO_TARKI_PNG.png')}}" style="width:30px"></a></li>
                    </ul>
                </nav>
                <!-- //nav -->
            </div>
        </div>
        <!-- //nav -->
        <!-- banner slider -->
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
            <!-- //banner-w3ls-info -->
        </div>
        <!-- //banner slider -->
    </div>
    <!-- //banner -->

    <!-- //home -->

    @yield('content')
    <!-- //testimonials -->

    <!-- footer -->
    <footer class="py-5">
        <div class="container py-sm-3">
            <div class="row footer-grids">
                <div class="col-lg-3 col-sm-6 mb-lg-0 mb-sm-5 mb-4">
                    <h2> <a class="navbar-brand mb-3" href="index.html">Tarakanita</a>
                    </h2>
                    <p class="mb-3">Onec Consequat sapien ut cursus rhoncus. Nullam dui mi, vulputate ac metus semper quis luctus sed.</p>
                    <h5>Trusted by <span>500+ People</span> </h5>
                </div>
                <div class="col-lg-3 col-sm-6 mb-md-0 mb-sm-5 mb-4">
                    <h4 class="mb-4">Address Info</h4>
                    <p><span class="fa mr-2 fa-map-marker"></span>64d canal street TT 9436 <span>Newyork, NY.</span></p>
                    <p class="phone py-2"><span class="fa mr-2 fa-phone"></span> +1(12) 123 456 789 </p>
                    <p><span class="fa mr-2 fa-envelope"></span><a href="mailto:info@example.com">info@example.com</a></p>
                </div>
                <div class="col-lg-2 col-sm-6 mb-lg-0 mb-sm-5 mb-4">
                    <h4 class="mb-4">Quick Links</h4>
                    <ul>
                        <li><a href="#">Online Education</a></li>
                        <li class="my-2"><a href="#">Free Application</a></li>
                        <li><a href="#">Support Helpline</a></li>
                        <li class="mt-2"><a href="#">Privacy Ploicy</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <h4 class="mb-4">Subscribe Us</h4>
                    <p class="mb-3">Subscribe to our newsletter</p>
                    <form action="#" method="post" class="d-flex newsletter-w3pvt">
                        <input type="email" id="email" name="EMAIL" placeholder="Enter your email here" required="">
                        <button type="submit" class="btn">Subscribe</button>
                    </form>
                    <div class="icon-social mt-4">
                        <a href="#" class="button-footr">
                            <span class="fa mx-2 fa-facebook"></span>
                        </a>
                        <a href="#" class="button-footr">
                            <span class="fa mx-2 fa-twitter"></span>
                        </a>
                        <a href="#" class="button-footr">
                            <span class="fa mx-2 fa-dribbble"></span>
                        </a>
                        <a href="#" class="button-footr">
                            <span class="fa mx-2 fa-pinterest"></span>
                        </a>
                        <a href="#" class="button-footr">
                            <span class="fa mx-2 fa-google-plus"></span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- //footer -->
    <!-- copyright -->
    <div class="copy_right p-3 d-flex justify-content-around">

        <p>© 2019 EduWily. All rights reserved | Design by
            <a href="http://w3layouts.com/">W3layouts</a>

        </p>
        <!-- move top -->
        <div class="move-top">
            <a href="#home" class="move-top">
                <span class="fa fa-angle-double-up mt-3" aria-hidden="true"></span>
            </a>
        </div>
        <!-- move top -->
    </div>
    <!-- //copyright -->
    <section id="copyright">

    </section>





</body>

</html>
