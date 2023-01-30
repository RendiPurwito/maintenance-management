<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{--! JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    {{--! Toastr CSS CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{--! Toastr JS CDN --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    {{--! Form Builder CSS --}}
    @stack('styles')

    {{--! Bootstrap --}}
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">

    {{--! DataTable CSS --}}
    <link rel="stylesheet" href="/datatable/DataTables-1.13.1/css/jquery.dataTables.css">


    {{--! Voler CSS --}}
    <link rel="stylesheet" href="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">


    {{--! Font Awesome --}}
    <script src="https://kit.fontawesome.com/e5a524ad24.js"></script>

    {{--! Box Icon  --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{--! Specific Page CSS --}}
    @yield('css')

    {{--! Custom CSS --}}
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper ">
                <div class="sidebar-header">
                    <img src="/img/logo.png" alt="" srcset="" style="width: 8rem">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        @if (auth()->user()->role == 'field_support')
                        <li class="sidebar-item  @if (\Request::is('dashboard')) active  @endif">
                            <a href="/dashboard" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  @if (\Request::is('my-submissions*')) active  @endif">
                            <a href="/form-builder/my-submissions" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>My Submissions</span>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->role == 'admin')
                        <li class="sidebar-item @if (\Request::is('admin')) active  @endif">
                            <a href="/admin" class='sidebar-link '>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item @if (\Request::is('admin/user')) active  @endif">
                            <a href="/admin/user" class='sidebar-link '>
                                <i data-feather="user" width="20"></i>
                                <span>User</span>
                            </a>
                        </li>

                        <li class="sidebar-item @if (\Request::is('form-builder/forms')) active  @endif">
                            <a href="/form-builder" class='sidebar-link'>
                                <i data-feather="file-plus" width="20"></i>
                                <span>Form</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light bg-white shadow-sm">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div>
                    <img src="/img/logo.png" alt="" srcset="" style="width: 8rem" class="image">
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-none d-md-block d-lg-inline-block">Hi, {{auth()->user()->name}}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="main-content container-fluid">
                @yield('content')
                <section class="section">
                </section>
            </div>
        </div>
    </div>
    {{--! Form Builder JS --}}
    @stack('scripts')

    {{--! Bootstrap JS --}}
    <script src="/bootstrap/dist/js/bootstrap.js"></script>


    {{--! Voler JS --}}
    <script src="/template/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/template/dist/assets/js/app.js"></script>
    <script src="/template/dist/assets/js/main.js"></script>

    {{--! Specific Page JS --}}
    @yield('javascript')

    {{--! Sweet Alert JS --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{--! DataTable JS CDN --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    {{--! Custom JS  --}}
    <script src="/js/script.js"></script>

</body>

</html>