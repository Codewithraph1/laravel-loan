<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Multi-purpose admin dashboard template that especially build for programmers.">
    <title>Admin - {{ config('web.title') }} || {{ config('web.name') }}</title>
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


    <link rel="stylesheet" href="{{ asset('assets/admin/css/style88f9.css?v1.1.3') }}">
</head>

<body class="nk-body" data-sidebar-collapse="lg" data-navbar-collapse="lg">
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-sidebar nk-sidebar-fixed is-theme" id="sidebar">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand"><a href="{{ route('admin.dashboard') }}" class="logo-link">
                            <div class="logo-wrap">
                                <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">

                            </div>
                        </a>
                        <div class="nk-compact-toggle me-n1"><button
                                class="btn btn-md btn-icon text-light btn-no-hover compact-toggle"><em
                                    class="icon off ni ni-chevrons-left"></em><em
                                    class="icon on ni ni-chevrons-right"></em></button></div>
                        <div class="nk-sidebar-toggle me-n1"><button
                                class="btn btn-md btn-icon text-light btn-no-hover sidebar-toggle"><em
                                    class="icon ni ni-arrow-left"></em></button></div>
                    </div>
                </div>
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-item has-sub"><a href="{{ route('admin.dashboard') }}" class="nk-menu-link "><span
                                            class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span><span
                                            class="nk-menu-text">Dashboard</span></a>

                                </li>
                               
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-users"></em>
                                        </span>
                                        <span class="nk-menu-text">User Management</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ route('admin.users.index') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">Users List</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                                        <span class="nk-menu-text">Loan management</span>
                                    </a>
                                    <ul class="nk-menu-sub">

                                        <li class="nk-menu-item"><a href="{{ route('admin.loans.index') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Loans</span></a></li>

                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                                        <span class="nk-menu-text">Loan Repayment</span>
                                    </a>
                                    <ul class="nk-menu-sub">

                                        <li class="nk-menu-item"><a href="{{ route('admin.payments.index') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Payments</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.payments.pending') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Pending Payments</span></a></li>

                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-wallet"></em></span>
                                        <span class="nk-menu-text">Bank Accounts</span>
                                    </a>
                                    <ul class="nk-menu-sub">

                                        <li class="nk-menu-item"><a href="{{ route('admin.accounts.create') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Create Bank</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('admin.accounts.index') }}"
                                                class="nk-menu-link"><span class="nk-menu-text">Bank List</span></a>
                                        </li>
                                    </ul>
                                </li>
                                
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-wrap">
                <div class="nk-header nk-header-fixed ">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-logo ms-n1">
                                <div class="nk-sidebar-toggle"><button
                                        class="btn btn-sm btn-icon btn-zoom sidebar-toggle d-sm-none"><em
                                            class="icon ni ni-menu"></em></button><button
                                        class="btn btn-md btn-icon btn-zoom sidebar-toggle d-none d-sm-inline-flex"><em
                                            class="icon ni ni-menu"></em></button></div>
                                <div class="nk-navbar-toggle me-2"><button
                                        class="btn btn-sm btn-icon btn-zoom navbar-toggle d-sm-none"><em
                                            class="icon ni ni-menu-right"></em></button><button
                                        class="btn btn-md btn-icon btn-zoom navbar-toggle d-none d-sm-inline-flex"><em
                                            class="icon ni ni-menu-right"></em></button></div><a href="{{ route('admin.dashboard') }}"
                                    class="logo-link">
                                    <div class="logo-wrap">
                                        <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">

                                    </div>
                                </a>
                            </div>
                            <nav class="nk-header-menu nk-navbar">
                                <ul class="nk-nav">
                                    <span>Welcome,
                                        @if(Auth::guard('admin')->check())
                                        {{ Auth::guard('admin')->user()->name }}
                                        @else
                                        Admin
                                        @endif
                                    </span>
                                </ul>
                            </nav>
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav ms-2">

                                    <li><button class="btn btn-icon btn-sm btn-zoom d-sm-none"
                                            data-bs-toggle="offcanvas" data-bs-target="#notificationOffcanvas"><em
                                                class="icon ni ni-bell"></em></button><button
                                            class="btn btn-icon btn-md btn-zoom d-none d-sm-inline-flex"
                                            data-bs-toggle="offcanvas" data-bs-target="#notificationOffcanvas"><em
                                                class="icon ni ni-bell"></em></button></li>
                                    <li class="dropdown"><a href="#" data-bs-toggle="dropdown">
                                            <div class="d-sm-none">
                                                <div class="media media-md media-circle"><img src="images/avatar/a.jpg"
                                                        alt="" class="img-thumbnail"></div>
                                            </div>
                                            <div class="d-none d-sm-block">
                                                <div class="media media-circle"> <img class="img-thumbnail" src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md">
                                            <div
                                                class="dropdown-content dropdown-content-x-lg py-3 border-bottom border-light">
                                                <div class="media-group">
                                                    <div class="media media-xl media-middle media-circle">
                                                        <img class="img-thumbnail" src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">


                                                    </div>
                                                    <div class="media-text">
                                                        <div class="lead-text"><span> {{ Auth::guard('admin')->user()->name }}</span></div><span
                                                            class="sub-text">{{ Auth::guard('admin')->user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="dropdown-content dropdown-content-x-lg py-3 border-bottom border-light">
                                                <ul class="link-list">
                                                    <li><a href="{{ route('admin.settings.edit') }}"><em
                                                                class="icon ni ni-setting-alt"></em> <span>Account
                                                                Settings</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-content dropdown-content-x-lg py-3">
                                                <ul class="link-list">
                                                    <li>
                                                        <form method="POST" action="{{ route('admin.logout') }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                                                <em class="icon ni ni-signout"></em>
                                                                <span>Log Out</span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>


                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="content pt-5">
                    @yield('content')
                </div>


                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright">
                                <p>Copyright&copy; {{ config('web.title') }}
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script>. <br class="d-sm-none">

                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="{{ asset('assets/admin/js/bundle88f9.js?v1.1.3') }}"></script>
<script src="{{ asset('assets/admin/js/scripts88f9.js?v1.1.3') }}"></script>

<script src="{{ asset('assets/admin/js/charts/analytics-chart.js') }}"></script>


</html>