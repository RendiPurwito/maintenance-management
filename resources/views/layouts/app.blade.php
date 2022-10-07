<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('styles')
    <link rel="stylesheet" href="/template/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/template/dist/assets/vendors/chartjs/Chart.min.css">
    <link rel="stylesheet" href="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">
    <link rel="shortcut icon" href="/template/dist/assets/images/favicon.svg" type="image/x-icon">
    {{-- JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" referrerpolicy="no-referrer"></script>
    {{-- Font Awesome --}}
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
                    <img src="/template/assets/images/logo.svg" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        @if (auth()->user()->role == 'user')
                        <li class="sidebar-item  @if (\Request::is('dashboard*')) active  @endif">
                            <a href="dashboard" class='sidebar-link'>
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
                                <span>Form Builder</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
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
                <section class="section">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="/template/dist/assets/js/feather-icons/feather.min.js"></script>
    <script src="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/template/dist/assets/js/app.js"></script>
    <script src="/template/dist/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="/template/dist/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="/template/dist/assets/js/pages/dashboard.js"></script>
    <script src="/template/dist/assets/js/main.js"></script>
    @yield('javascript')
    {{-- Sweet Alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('#submitButton').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                icon: "warning",
                title: "Are you sure?",
                text: "Save this user definition?",
                buttons: true,
                dangerMode: true
            }).then((isConfirm) => {
                if (isConfirm) {
                    form.submit();
                    swal({
                        icon: "success",
                        title: 'User successfully created!',
                    });
                }
            });
        });

        $('#submitEditButton').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                icon: "warning",
                title: "Are you sure?",
                text: "Save this user definition?",
                buttons: true,
                dangerMode: true
            }).then((isConfirm) => {
                if (isConfirm) {
                    form.submit();
                    swal({
                        icon: "success",
                        title: 'User successfully updated!',
                    });
                }
            });
        });

        function confirmDel(id) {
            let url = $('#deleteButton').attr('data-name');
            swal({
                icon: 'warning',
                title: 'Are you sure?',
                text: 'This action cannot be undone!',
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/" + url + "/" + id
                    swal({
                        icon: "success",
                        title: 'User successfully deleted!',
                    });
                }
            })
        }

        // $('.delete-button').on('click', function (event) {
        //     // return confirm('Are you sure want to delete?');
        //     event.preventDefault();//this will hold the url
        //     Swal.fire({
        //         title: 'Are you sure ?',
        //         text: "You won't be able to revert this !",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             swal("Done! category has been softdeleted!", {
        //                 icon: "success",
        //                 button: false,
        //             });
        //         location.reload(true);//this will release the event
        //         } else {
        //             swal("Your imaginary file is safe!");
        //         }
        //     });
        // });
    </script>

</body>

</html>