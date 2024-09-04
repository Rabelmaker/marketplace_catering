<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Spruha - Laravel Bootstrap5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin dasboard, admin panel, dashboard, template dashboard, laravel template, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, laravel dashboard, admin panel design, vite laravel, admin dashboard bootstrap">

    <!-- TITLE -->
    <title> Label - Login </title>

    <!-- FAVICON -->
    <link rel="icon" href="{{asset('theme/spruha')}}/build/assets/img/brand/labelicon.png" type="image/x-icon">

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/icons.css" rel="stylesheet">
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/font-awesome/font-awesome.min.css"
          rel="stylesheet">
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/plugin.css" rel="stylesheet">

    <!-- APP SCSS -->
    <link rel="preload" as="style" href="{{asset('theme/spruha')}}/build/assets/app-58d9b917.css"/>
    <link rel="stylesheet" href="{{asset('theme/spruha')}}/build/assets/app-58d9b917.css"/>

    <!-- APP CSS -->
    <link rel="preload" as="style" href="{{asset('theme/spruha')}}/build/assets/app-e6039df9.css"/>
    <link rel="stylesheet" href="{{asset('theme/spruha')}}/build/assets/app-e6039df9.css"/>
</head>

<body class="ltr main-body leftmenu error-1">

<!-- LOADER -->
<div id="global-loader">
    <img src="{{asset('theme/spruha')}}/build/assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- END LOADER -->

<!-- MAIN-CONTENT -->

<!-- Page -->
<div class="page main-signin-wrapper">
    <!-- Row -->
    <div class="row signpages text-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row row-sm">
                    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center bg-primary details">
                        <div class="mt-5 pt-4 p-2 pos-absolute">
                            <img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelputih.png"
                                 class="header-brand-img mb-4" alt="logo">
                            <div class="clearfix"></div>
                            <img src="{{asset('theme/spruha')}}/build/assets/img/svgs/user.svg" class="ht-100 mb-0"
                                 alt="user">
                            <h5 class="mt-4 text-white">Buat Akun Admin</h5>
                            <span class="tx-white-6 tx-13 mb-5 mt-xl-0">Registrasi untuk terhubung dengan kami</span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                        <div class="main-container container-fluid">
                            <div class="row row-sm">
                                <div class="card-body mt-2 mb-2">
                                    <img src="{{asset('theme/spruha')}}/build/assets/img/brand/logo-light.png"
                                         class="d-lg-none header-brand-img text-start float-start mb-4 error-logo-light"
                                         alt="logo">
                                    <img src="{{asset('theme/spruha')}}/build/assets/img/brand/logo.png"
                                         class=" d-lg-none header-brand-img text-start float-start mb-4 error-logo"
                                         alt="logo">
                                    <div class="clearfix"></div>
                                    <form method="post" action="{{ route('post_login') }}">
                                        @csrf
                                        <h5 class="text-start mb-2">Login Admin</h5>
                                        <p class="mb-4 text-muted tx-13 ms-0 text-start">Login untuk koneksi dan setting absensi</p>
                                        <div class="form-group text-start">
                                            <label>Username</label>
                                            <input class="form-control" placeholder="Enter your username" name="username" type="text">
                                        </div>
                                        <div class="form-group text-start">
                                            <label>Password</label>
                                            <input class="form-control" placeholder="Enter your password" name="password"
                                                   type="password">
                                        </div>
                                        <button type="submit" class="btn btn-main-primary btn-block text-white">Login</button>
                                    </form>
                                    <div class="text-start mt-5 ms-0">
                                        <div class="mb-1"><a href="forgot.html">Forgot password?</a></div>
                                        <div>Belum punya akun? <a href="{{route('register')}}">Daftar disini</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
</div>
<!-- End Page -->

<!-- END MAIN-CONTENT -->


<!-- SCRIPTS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/select2/js/select2.min.js"></script>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"></script>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/themeColors-71fc6433.js"></script>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/app-53348e21.js"></script>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/switcher-4de6c754.js"></script>
<!-- END SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    // SweetAlert for login success or failure
    @if(session('gagal'))
    $(document).ready(function () {
        Swal.fire({
            title: 'Error',
            text: '{{ session('gagal') }}',
            type: 'error',
            showConfirmButton: false,
            timer: 3000,
            position: 'top-end',
        });
    });
    @endif

</script>
</body>
</html>
