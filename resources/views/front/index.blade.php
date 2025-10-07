@extends('layouts.front')
@section('content')



<main>

    <!-- banner section -->
    <section class="banner-area-6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="banner-content wow fadeInRight" data-wow-delay="0.2s">
                        <h1>Get The Best Loans With Flexible Payment Plans</h1>
                        <p>At {{ config('app.name', config('web.title', 'Our Company')) }}, we provide affordable loan solutions with competitive rates and extended repayment periods to meet your financial needs.</p>
                        <div class="d-flex flex-column flex-sm-row mt-25 subscribe-field">
                            <input type="email" class="form-control me-sm-1" placeholder="Enter Email address">
                            <a href="{{ route('loan') }}" class="input-append theme-btn theme-btn-lg ms-sm-2">Apply Now</a>
                        </div>
                        <ul class="list-unstyled feature-list mt-4">
                            <li><i class="fas fa-check-circle text-success"></i> Competitive Interest Rates</li>
                            <li><i class="fas fa-check-circle text-success"></i> Flexible Repayment Terms</li>
                            <li><i class="fas fa-check-circle text-success"></i> Quick Approval Process</li>
                            <li><i class="fas fa-check-circle text-success"></i> No Hidden Charges</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 text-center text-lg-start">
                    <div class="banner-img position-relative">
                        <img class="img-1 wow fadeInLeft" data-wow-delay="0.3s" src="{{ asset('assets/front/img/home-5/banner-img-1.png') }}" alt="Loan Application">
                        <img class="img-2 wow fadeInRight" data-wow-delay="0.8s" src="{{ asset('assets/front/img/home-5/banner-img-2.png') }}" alt="Fast Approval">
                        <img class="img-3 wow fadeInRight" data-wow-delay="1.1s" src="{{ asset('assets/front/img/home-5/banner-img-3.png') }}" alt="Secure Banking">
                        <img class="img-shape position-absolute" src="{{ asset('assets/front/img/home-5/banner-shape.png') }}" alt="Background Shape">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="banner-fact bg-light py-5">
        <div class="container">
            <div class="row gy-lg-0 gy-4">
                <div class="col-lg-4 col-md-6 wow fadeInRight" data-wow-delay="0.1s">
                    <div class="single-fact text-center">
                        <div class="icon text-primary mb-3">
                            <i class="fas fa-hand-holding-usd fa-3x"></i>
                        </div>
                        <h3 class="text-primary">50M+</h3>
                        <p class="mb-0">Loans Disbursed</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="single-fact text-center">
                        <div class="icon text-success mb-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <h3 class="text-success">25K+</h3>
                        <p class="mb-0">Happy Customers</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInRight mx-auto" data-wow-delay="0.7s">
                    <div class="single-fact text-center">
                        <div class="icon text-warning mb-3">
                            <i class="fas fa-award fa-3x"></i>
                        </div>
                        <h3 class="text-warning">10+ Years</h3>
                        <p class="mb-0">Industry Experience</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- feature section -->
    <section class="pt-115 pb-105 feature-area-3">
        <div class="container">
            <div class="section-title text-center">
                <span class="short-title-2">WHY CHOOSE {{ strtoupper(config('app.name', config('web.title', 'US'))) }}</span>
                <h1 class="wow fadeInUp">Our Loan Features & Benefits</h1>
                <p class="wow fadeInUp mt-3">We provide comprehensive loan solutions tailored to your financial needs</p>
            </div>
            <div class="row gy-4 mt-50">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-bolt text-primary fa-2x"></i>
                        </div>
                        <h5>Quick Approval</h5>
                        <p>Get your loan approved within 24 hours with minimal documentation</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-percentage text-success fa-2x"></i>
                        </div>
                        <h5>Low Interest Rates</h5>
                        <p>Competitive rates starting from 5.9% to make borrowing affordable</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-calendar-alt text-info fa-2x"></i>
                        </div>
                        <h5>Flexible Terms</h5>
                        <p>Choose repayment periods from 12 to 60 months that suit your budget</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-shield-alt text-warning fa-2x"></i>
                        </div>
                        <h5>100% Secure</h5>
                        <p>Bank-level security to protect your personal and financial information</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="0.9s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-eye-slash text-danger fa-2x"></i>
                        </div>
                        <h5>No Hidden Fees</h5>
                        <p>Transparent pricing with no surprise charges or processing fees</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="1.1s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-laptop text-purple fa-2x"></i>
                        </div>
                        <h5>Online Application</h5>
                        <p>Apply from anywhere with our simple and user-friendly online platform</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp" data-wow-delay="1.3s">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-headset text-teal fa-2x"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p>Round-the-clock customer service to assist you at every step</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="feature-card-widget-9 wow fadeInUp widget-link text-center" data-wow-delay="1.7s">
                        <h1 class="display-4 text-primary">10+</h1>
                        <p class="mb-3">More Benefits Available</p>
                        <a href="user/login" class="btn btn-primary btn-lg">Apply Now <i class="arrow_right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature section end-->
    <section class="about-area-2 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 wow fadeInLeft">
                    <div class="text-start">
                        <h1 class="mb-3">Get Your Loan in 3 Simple Steps</h1>
                        <p>At {{ config('app.name', config('web.title', 'Our Company')) }}, we've streamlined the loan process to make it quick, easy, and hassle-free for our customers.</p>
                        <ul class="list-unstyled feature-list">
                            <li><i class="fas fa-check-circle text-success"></i> Complete our simple online application form in minutes</li>
                            <li><i class="fas fa-check-circle text-success"></i> Get instant approval decision with competitive rates</li>
                            <li><i class="fas fa-check-circle text-success"></i> Receive funds directly to your account within 24 hours</li>
                        </ul>
                        <a href="{{ route('loan') }}" class="read-more-btn">
                            <span>Apply for Your Loan Now</span>
                            <i class="arrow_right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight">
                    <div class="sms-flow">
                        <img class="arrow-1" src="{{ asset('assets/front/img/home-5/about-arrow-1.png') }}" alt="Application Step">
                        <img class="arrow-2" src="{{ asset('assets/front/img/home-5/about-arrow-2.png') }}" alt="Approval Step">
                        <img class="msg-1 wow fadeInUp" data-wow-delay="0.1s" src="{{ asset('assets/front/img/home-5/msg-1.png') }}" alt="Easy Application">
                        <img class="msg-2" src="{{ asset('assets/front/img/home-5/msg-2.png') }}" alt="Quick Approval">
                        <img class="msg-3 wow fadeInDown" data-wow-delay="0.3s" src="{{ asset('assets/front/img/home-5/msg-3.png') }}" alt="Fast Funding">
                    </div>
                </div>
            </div>

            <div class="row align-items-center gy-4 mt-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="card-holder position-relative">
                        <div class="shape-1"></div>
                        <div class="shape-2"></div>
                        <img class="img-1 img-fluid" src="{{ asset('assets/front/img/home-5/card-holder.png') }}" alt="Secure Banking">
                        <img class="img-2 wow fadeInRight" data-wow-delay="0.2s" src="{{ asset('assets/front/img/home-5/bank-balance.png') }}" alt="Financial Growth">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1 wow fadeInRight">
                    <h1 class="mb-3">Trusted by Thousands of Satisfied Customers</h1>
                    <p>With years of experience in the financial industry, we've built strong relationships with our customers by providing transparent, reliable, and affordable loan solutions. Our commitment to excellent service has made us a preferred choice for personal and business financing.</p>

                    <div class="customer-num d-flex gap-5 mt-4">
                        <div class="text-center">
                            <h1 class="text-primary">50+</h1>
                            <span>Banking<br>Partners</span>
                        </div>
                        <div class="text-center">
                            <h1 class="text-success">25K+</h1>
                            <span>Happy<br>Customers</span>
                        </div>
                        <div class="text-center">
                            <h1 class="text-warning">$50M+</h1>
                            <span>Loans<br>Disbursed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <!-- About Us section -->
    <section class="about-area-3 bg-white pb-lg-120 pb-60">
        <div class="container">
            <div class="section-title text-center">
                <span class="short-title-2">WHY CHOOSE US</span>
                <h1 class="wow fadeInUp">Why Thousands Trust {{ config('app.name', config('web.title', 'Our Company')) }}</h1>
            </div>
            <div class="row align-items-center pt-60 gy-lg-0 gy-4">
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.1s">
                    <div class="mb-5">
                        <h5><span class="round-dot bg-primary"></span> <span class="text-primary">25,000+</span> Active Customers</h5>
                        <p>Join thousands of satisfied customers who have achieved their financial goals with our reliable loan solutions and exceptional customer service.</p>
                    </div>
                    <div class="mb-5">
                        <h5><span class="round-dot bg-success"></span> <span class="text-success">50+</span> Banking Partners</h5>
                        <p>We collaborate with leading financial institutions to bring you the best loan products and most competitive rates in the market.</p>
                    </div>
                    <div class="mb-5">
                        <h5><span class="round-dot bg-warning"></span> <span class="text-warning">10+</span> Years Experience</h5>
                        <p>With over a decade of expertise in financial services, we have the knowledge and experience to guide you to the right financial decisions.</p>
                    </div>
                    <div class="mt-40">
                        <a href="{{ route('about') }}" class="btn btn-outline-primary">Learn More About Us</a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.3s">
                    <div class="video-tut position-relative">
                        <img src="{{ asset('assets/front/img/home-5/about-us-img.png') }}" alt="About {{ config('app.name', config('web.title', 'Our Company')) }}">
                        <a class="play-btn" data-fancybox href="https://www.youtube.com/watch?v=xcJtL7QggTI" tabindex="0">
                            <i class="fas fa-play"></i>
                        </a>
                        <div class="video-overlay-text">
                            <h5>Watch Our Success Story</h5>
                            <p>See how we've helped thousands achieve financial freedom</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us section -->


</main>

@endsection