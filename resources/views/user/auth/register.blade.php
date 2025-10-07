<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Auth Register - {{ config('web.title') }} || {{ config('web.name') }}</title>
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
</head>

<body class="@@class">


    <div class="authincation section-padding">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-xl-5 col-md-6">
                    <div class="mini-logo text-center my-4">
                        <a href="">
                            <img src="{{ asset('assets/front/img/logo/logo-black.png') }}" srcset="{{ asset('assets/front/img/logo/logo-black.png') }}" alt="logo">
                         </a>
                        <h4 class="card-title mt-5">Create your account</h4>
                    </div>
                    @if(session('success'))
                    <div style="color: green;">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="auth-form card">
                        <div class="card-body">
                            <form method="POST" class="signin_validate row g-3" action="{{ route('user.register') }}">
                                @csrf


                                <div class="col-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname') }}" required autofocus>
                                </div>
                                <div class="col-12 ">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                </div>
                                <div class="col-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            I certify that I am 18 years of age or older, and agree to the <a href="#"
                                                class="text-primary">User Agreement</a> and <a href="#"
                                                class="text-primary">Privacy Policy</a>.
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Create account</button>
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="mt-3 mb-0"> <a class="text-primary" href="{{ route('user.login') }}">Sign in</a> to your
                                    account</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/scripts.js') }}"></script>


</body>

</html>