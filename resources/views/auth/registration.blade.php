<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="/template/dist/assets/css/bootstrap.css">

    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="/img/logo.png" height="70" class='mb-4'>
                                <h3>Sign Up</h3>
                                <p>Please fill the form to register.</p>
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
                                            <label for="no_telepon-column">No Telepon</label>
                                            <input type="number" id="no_telepon-column" class="form-control"
                                                name="no_telepon">
                                                @if ($errors->has('no_telepon'))
                                                <span class="text-danger">{{ $errors->first('no_telepon') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat-column">Alamat</label> <br>
                                            <textarea name="alamat" id="alamat-column" class="col-12" rows="2"></textarea>
                                            @if ($errors->has('alamat'))
                                            <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </diV>

                                <a href="/">Have an account? Login</a>
                                <div class="clearfix">
                                    <button class="btn btn-primary float-right" type="submit">Submit</button>
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