<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{ config('web.title') }} || {{ config('web.name') }} || {{ config('web.description') }}</title>

    <!-- Favicon Icon for most browsers -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/front/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/front/favicon/favicon-16x16.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/front/favicon/favicon.ico') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/front/favicon/apple-touch-icon.png') }}">

    <!-- Android Chrome Icon -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/front/favicon/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/front/favicon/android-chrome-512x512.png') }}">

    <!-- Manifest (optional for PWA or modern apps) -->
    <link rel="manifest" href="{{ asset('assets/front/favicon/site.webmanifest') }}">

    <!-- CSS here -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/bootstrap.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/elegant-icons.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/all.min.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/animate.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/nice-select.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/default.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/style.css') }}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/responsive.css') }}" media="all" />
</head>

<body>
    <!-- Preloader -->
    <!-- <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="round_spinner">
                <div class="spinner"></div>
                <div class="text">
                    <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="">
                </div>
            </div>
            <h2 class="head">Welcome !!</h2>
           
        </div>
    </div> -->
    <!-- Header -->
    <header class="header">
        <div class="header-top py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="header-info-left">

                            <div class="language-list">
                                <select id="select-lang">
                                    <option value="English">English</option>
                                    <option value="Bangla">Bangla</option>
                                    <option value="French">French</option>
                                    <option value="Hindi">Hindi</option>
                                </select>
                            </div>

                            <div class="timestamp ms-4"> <i class="icon_clock_alt"></i> Mon - Fri 10:00-18:00
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="header-info-right">
                            <ul>
                                <li>
                                    <img class="img-fluid" src="{{ asset('assets/front/img/phone-outline-white.png') }}" alt="phone"><a
                                        href="">{{ config('web.number') }}</a>
                                </li>

                                <li>
                                    <i class="icon_mail_alt"></i><a
                                        href="">{{ config('web.email') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-menu header-menu-2" id="sticky">
            <nav class="navbar navbar-expand-lg ">
                <div class="container">
                    <a class="navbar-brand" href="">
                        <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_toggle">
                            <span class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                            <span class="hamburger-cross">
                                <span></span>
                                <span></span>
                            </span>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav menu ms-auto">
                            <li class="nav-item dropdown submenu">
                                <a href="{{ route('home') }}" class="nav-link dropdown-toggle active" role="button">Home</a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a href="{{ route('about') }}" class="nav-link" role="button">About Us</a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a href="{{ route('loan') }}" class="nav-link" role="button">Loans</a>
                            </li>
                            <li class="nav-item dropdown submenu">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Services
                                </a>
                                <i class="arrow_carrot-down_alt2 mobile_dropdown_icon" aria-hidden="false"
                                    data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('loan') }}">Our Services</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('testimony') }}">Testimony</a></li>
                                </ul>
                            </li>
                        </ul>
                        <a class="theme-btn"
                            href="user/register"
                            target="_blank">Get Started</a>
                        <div class="px-2 js-darkmode-btn" title="Toggle dark mode">
                            <label for="something" class="tab-btn tab-btns">
                                <ion-icon name="moon"></ion-icon>
                            </label>
                            <label for="something" class="tab-btn">
                                <ion-icon name="sunny"></ion-icon>
                            </label>
                            <label class=" ball" for="something"></label>
                            <input type="checkbox" name="something" id="something" class="dark_mode_switcher">
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- Header end-->





    <div class="content">
        @yield('content')
    </div>






    <!-- footer -->
    <footer class="footer footer-3">
        <div class="footer-top  pt-200 pb-lg-115 pb-120">
            <div class="container">
                <div class="row gx-0 pt-45 ">

                    <div class="col-lg-4 col-sm-6 text-center text-sm-start ms-0 ">
                        <div class="footer-widget wow fadeInLeft mb-30">



                            <div class="footer-text mb-20">
                                <p>Banca is a leading bank in the worldzone and a prominent international banking
                                    institution</p>
                            </div>

                        </div>
                    </div>
                    // ...existing code...
                    <div class="col-lg-2 col-sm-6 text-center text-sm-start ms-lg-5 ">
                        <div class="footer-widget mb-30 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="f-widget-title">
                                <h5>{{ config('web.title') }}</h5>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('about') }}">About</a></li>
                                    <li><a href="{{ route('loan') }}">Loan</a></li>
                                    <li><a href="{{ route('contact') }}">Contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2  col-sm-6 text-center text-sm-start ms-lg-5">
                        <div class="footer-widget mb-30 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="f-widget-title">
                                <h5>Publications</h5>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    <li><a href="{{ route('terms') }}">Terms & Condition</a></li>
                                    <li><a href="{{ route('privacy') }}">Privacy & Policy</a></li>
                                    <li><a href="{{ route('faq') }}">Faq</a></li>
                                    <li><a href="{{ route('testimony') }}">Testimony</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    // ...existing code...

                   

                </div>
            </div>
        </div>
        <!-- copyright area -->
        <div class="copyright pt-25 pb-25">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 text-center text-lg-start">
                        <a href="" class="p-0 m-0"><img src="{{ asset('assets/front/img/logo/logo-white.png') }}" alt="logo"></a>
                    </div>
                    <div class="col-lg-5 text-center my-3 my-sm-0">
                        <div class="copyright-text">
                            <p>Copyright&copy; {{ config('web.title') }}
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>. <br class="d-sm-none">
                                <a class="ms-2" href="#">Privacy</a> |
                                <a class="ms-0" href="#">Term of Use</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 text-center text-lg-end ">
                        <div class="social-button">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Back to top button -->
    <a id="back-to-top" title="Back to Top"></a>

    <!-- JS here -->
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/preloader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.smoothscroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.waypoints.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.counterup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/parallax.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.parallax-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/front/dist/ionicons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/custom.js') }}"></script>
</body>

</html>