<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{--! JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" referrerpolicy="no-referrer"></script>

    {{--! Form Builder CSS --}}
    @stack('styles')

    {{--! Bootstrap --}}
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">

    {{--! DataTable CSS --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/fh-3.2.4/r-2.3.0/datatables.min.css" />


    {{-- Bootstrap CDN --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

    {{--! Voler CSS --}}
    <link rel="stylesheet" href="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">

    {{--! Footable CSS --}}
    {{-- <link rel="stylesheet" href="/footable/css/footable.bootstrap.css"> --}}

    {{--! Font Awesome --}}
    <script src="https://kit.fontawesome.com/e5a524ad24.js"></script>

    @yield('css')
    {{-- <style>
        *{
            border: 1px solid
        }
    </style> --}}
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
                        {{-- <li class="dropdown nav-icon">
                            <a href="#" data-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-large">
                                <h6 class='py-2 px-4'>Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                {{-- <div class="avatar mr-1">
                                    <img src="/template/dist/assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div> --}}
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
                {{-- <div class="page-title">
                    <h3>Dashboard</h3>
                    <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
                </div> --}}
                @yield('content')
                <section class="section">
                </section>
            </div>
        </div>
    </div>
    {{--! Form Builder JS --}}
    @stack('scripts')

    {{--! Footable JS --}}
    {{-- <script src="/footable/js/footable.js"></script> --}}

    {{--! Simple Datatables JS CDN --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}

    {{--! Voler JS --}}
    <script src="/template/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/template/dist/assets/js/app.js"></script>
    {{-- <script src="/template/dist/assets/vendors/chartjs/Chart.min.js"></script> --}}
    {{-- <script src="/template/dist/assets/vendors/apexcharts/apexcharts.min.js"></script> --}}
    {{-- <script src="/template/dist/assets/js/pages/dashboard.js"></script> --}}
    <script src="/template/dist/assets/js/main.js"></script>
    @yield('javascript')

    {{--! Sweet Alert JS --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{--! DataTable JS CDN --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/fh-3.2.4/r-2.3.0/datatables.min.js">
    </script>

    {{--! Function JS  --}}
    <script src="/js/script.js"></script>
</body>

</html>