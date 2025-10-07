<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $user->fullname }} - {{ config('web.title') }} || {{ config('web.name') }}</title>
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
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

</head>

<body class="dashboard">



    <div id="main-wrapper">


        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="header-content">
                            <div class="header-left">
                                <div class="brand-logo"><a class="mini-logo" href="{{ route('user.dashboard') }}"><img src="images/logoi.png" alt="" width="40"></a></div>
                                <div class="search">
                                    <form action="#">
                                        <div class="input-group"><input type="text" class="form-control" placeholder="Search Here"><span class="input-group-text"><i class="ri-search-line"></i></span></div>
                                    </form>
                                </div>
                            </div>
                            <div class="header-right">
                                <div class="dark-light-toggle"><span class="dark"><i class="ri-moon-line"></i></span><span class="light"><i class="ri-sun-line"></i></span></div>
                                <!-- Account Balance Section -->
                                <div class="nav-item me-3">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2" style="font-size:18px; color:#28a745;">
                                            <i class="fas fa-wallet"></i>
                                        </span>
                                        <span style="font-weight:600; font-size:16px; color:#333;">
                                            Balance: ₦{{ number_format($user->balance, 2) }}
                                        </span>
                                    </div>
                                </div>


                                <div class="dropdown profile_log dropdown">
                                    <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="user icon-menu active"><span><i class="ri-user-line"></i></span></div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu dropdown-menu-right">
                                        <div class="user-email">
                                            <div class="user">
                                                <span class="thumb"><img src="images/profile/3.png" alt=""></span>
                                                <div class="user-info">
                                                    <h5> {{ $user->fullname }}</h5>
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('user.profile') }}"><span><i class="ri-user-line"></i></span>Profile</a>
                                        <a class="dropdown-item" href="balance.html"><span><i class="ri-wallet-line"></i></span>Balance</a>
                                        <a class="dropdown-item" href="{{ route('user.settings') }}"><span><i class="ri-settings-3-line"></i></span>Settings</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <div class="brand-logo"><a class="full-logo" href="{{ route('user.dashboard') }}"><img src="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="" width="30"></a></div>
            <div class="menu">
                <ul>
                    <li><a href="{{ route('user.dashboard') }}">
                            <span><i class="ri-home-5-line"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('user.loans.create') }}">
                            <span><i class="ri-secure-payment-line"></i></span>
                            <span class="nav-text">Apply Loan</span>
                        </a>
                    </li>
                    <li><a href="{{ route('user.loans.index') }}">
                            <span><i class="ri-file-copy-2-line"></i></span>
                            <span class="nav-text">Loan List</span>
                        </a>
                    </li>
                    <li><a href="{{ route('user.settings') }}">
                            <span><i class="ri-settings-3-line"></i></span>
                            <span class="nav-text">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.loan-history') }}">
                            <span><i class="ri-history-line"></i></span>
                            <span class="nav-text">History</span>
                        </a>
                    </li>

                    <li class="logout">
                        <form method="POST" action="{{ route('user.logout') }}" style="display:inline;">
                            @csrf
                            <button type="submit" style="border: none; background: none; padding: 0; margin: 0; cursor: pointer; display: flex; align-items: center; color: inherit; font: inherit;">
                                <span><i class="ri-logout-circle-line"></i></span>
                                <span class="nav-text"></span>
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>



    </div>

    <script src="{{ asset('assets/user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins/chartjs-line-init.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins/chartjs-donut.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins/perfect-scrollbar-init.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/plugins/circle-progress-init.js') }}"></script>
    <script src="{{ asset('assets/user/js/scripts.js') }}"></script>

</body>

</html>