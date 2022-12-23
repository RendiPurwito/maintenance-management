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
                padding-top: 120px;
            }
        }
    </style>
</head>

<body>
    @if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}")
    </script>
    @endif

    @if (Session::has('error'))
    <script>
        toastr.error("{!! Session::get('error') !!}")
    </script>
    @endif
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="/img/logo.png" height="70" class='mb-3'>
                                {{-- <h3>Reset Password</h3> --}}
                                <p class="text-dark" style="font-weight: 500; font-size: 15px">Please enter your email and your new password</p>
                            </div>
                            <form action="/reset-password/{{ $token }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
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

                                <div class="form-group position-relative has-icon-left">
                                    <label for="password">New Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                            id="new_password" name="new_password" autofocus required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                        @error('new_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left">
                                    <label for="password-confirm">Confirm Password</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                            id="password-confirmation" name="confirm_password" autofocus required>
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                        @error('confirm_password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <button class="btn btn-primary float-right" type="submit">Reset Password</button>
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