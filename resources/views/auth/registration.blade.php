<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="/template/dist/assets/css/bootstrap.css">

    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
    <style>
        @media screen and (min-width: 360px) {
            .card-body{
                padding: 1.5rem 1rem;
            }
            a{
                text-decoration: none;
            }

            textarea{
                border: 1px solid #DFE3E7;
                border-radius: 0.25rem;
            }
        }
    </style>
</head>

<body>
    <div style="background: #6c757d; min-height: 100vh; padding-top: 50px; background-image: url(/img/auth.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card ">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img src="/img/logo.png" height="70" class='mb-4'>
                                <p class="text-dark" style="font-weight: 500; font-size: 16px">Please fill the form to register.</p>
                            </div>
                            <form action="/register" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name-column">Name</label>
                                            <input type="text" id="name-column" class="form-control"
                                                name="name">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password-column">Password</label>
                                            <input type="password" id="password-column" class="form-control"
                                                name="password">
                                                @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-column">Email</label>
                                            <input type="email" id="email-column" class="form-control"
                                                name="email">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="phone_number-column">Phone Number</label>
                                            <input type="number" id="phone_number-column" class="form-control"
                                                name="phone_number">
                                                @if ($errors->has('phone_number'))
                                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="address-column">Address</label> <br>
                                            <textarea name="address" id="address-column" class="col-12" rows="2"></textarea>
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </diV>

                                <div class="clearfix">
                                    <a href="/">Have an account? Login</a>
                                    <button class="btn btn-primary float-right" type="submit">Register</button>
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