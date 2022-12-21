<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="/template/dist/assets/css/bootstrap.css">
    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
    {{-- Toastr CSS CDN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" />
    {{-- JQUERY CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    {{-- Toastr JS CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-full-width",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <style>
        /* *{
            border: 1px solid black;
        } */
        .toast{
            max-width: 100%;
            margin-top: 50px;
        }
        @media screen and (min-width: 360px) {
            #auth{
                padding-top: 150px
            }
            a{
                text-decoration: none;
            }
        }
    </style>
</head>

<body>
    @if (Session::has('error'))
    {{-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError')}}
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div> --}}
    <script>
        toastr.error("{!! Session::get('error') !!}")
    </script>
    @endif

    @if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}")
    </script>
    @endif
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="/img/logo.png" height="70" class='mb-3'>
                                <p class="text-dark" style="font-weight: 500">Please enter your credentials below.</p>
                            </div>
                            <form action="/" method="POST">
                                @csrf
                                <div class="form-group position-relative has-icon-left">
                                    <label for="email">Email</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" autofocus required>
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left mb-3">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        {{-- <a href="auth-forgot-password.html" class='float-right'>
                                            <small>Forgot password?</small>
                                        </a> --}}
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class='form-check clearfix mb-4'>
                                    <div class="checkbox float-left">
                                        <input type="checkbox" id="remember_me" class='form-check-input' name="remember_me" value="1">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                    <div class="float-right">
                                        <a href="{{ route('forget.password.get') }}">Forgot Password?</a>
                                    </div>
                                    {{-- <div class="float-right">
                                        <a href="/register">Don't have an account?</a>
                                    </div>
                                    <div class="checkbox float-left">
                                        <input type="checkbox" id="checkbox1" class='form-check-input' >
                                        <label for="checkbox1">Remember me</label>
                                    </div> --}}
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a href="/register" class="align-items-baseline">Don't have an account?</a>
                                    <button class="btn btn-primary float-right font-weight-bold" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="/template/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="/template/dist/assets/js/app.js"></script>
    <script src="/template/dist/assets/js/main.js"></script>
   
</body>

</html>