

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Multi-purpose admin dashboard template that especially build for programmers.">
    <title>Admin Auth Login  - {{ config('web.title') }} || {{ config('web.name') }}</title>
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
            <div class="nk-wrap align-items-center justify-content-center">
                <div class="container p-2 p-sm-4">
                    <div class="wide-xs mx-auto">
                        <div class="text-center mb-5">
                            <div class="brand-logo mb-1"><a href="" class="logo-link">
                                    <div class="logo-wrap">
                                        <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">
                                    </div>
                                </a></div>
                            <h3> Admin Login</h3>
                        </div>
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Login Super Admin</h3>

                                    </div>
                                </div>
                                @if ($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form method="POST" action="{{ route('admin.login') }}">
                                    @csrf

                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-group"><label for="username" class="form-label">Email </label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group"><label for="password"
                                                    class="form-label">Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" name="password" id="password" required></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="form-check form-check-sm"><input class="form-check-input"
                                                        type="checkbox" name="remember" id="rememberMe"><label
                                                        class="form-check-label" for="rememberMe"> Remember Me </label>
                                                
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <div class="d-grid"><button class="btn btn-primary" type="submit">Login to
                                                    account</button></div>
                                        </div>
                                    </div>
                                </form>
                               
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

</html>