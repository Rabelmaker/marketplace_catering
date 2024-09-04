<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Spruha - Laravel Bootstrap5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin dashboard, admin panel, dashboard, template dashboard, laravel template, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, laravel vite, laravel admin dashboard, bootstrap dashboard, laravel dashboard, admin panel design, vite laravel, admin dashboard bootstrap">

    <title> Register - Label Admin </title>

    <link rel="icon" href="{{asset('theme/spruha')}}/build/assets/img/brand/labelicon.png" type="image/x-icon">
    <link id="style" href="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/icons.css" rel="stylesheet">
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('theme/spruha')}}/build/assets/plugins/web-fonts/plugin.css" rel="stylesheet">
    <link rel="preload" as="style" href="{{asset('theme/spruha')}}/build/assets/app-58d9b917.css"/>
    <link rel="stylesheet" href="{{asset('theme/spruha')}}/build/assets/app-58d9b917.css"/>
    <link rel="preload" as="style" href="{{asset('theme/spruha')}}/build/assets/app-e6039df9.css"/>
    <link rel="stylesheet" href="{{asset('theme/spruha')}}/build/assets/app-e6039df9.css"/>
</head>

<body class="ltr main-body leftmenu">
<div id="global-loader">
    <img src="{{asset('theme/spruha')}}/build/assets/img/loader.svg" class="loader-img" alt="Loader">
</div>

<div>
    <div class="main-content pt-0 px-5">
        <div class="main-container container-fluid">
            <div class="inner-body">
                <div class="page-header">
                    <div>
                        <h2 class="main-content-title tx-24 mg-b-5">Form Registrasi</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Auth</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Registrasi</li>
                        </ol>
                    </div>
                    <div class="text-start">
                        <div>Apakah sudah punya akun? <a href="{{route('login')}}">Login disini</a></div>
                    </div>
                </div>

                <div class="row row-sm">
                    <div class="col-lg-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div>
                                    <h6 class="main-content-label mb-1">Form pengisian akun dan informasi sekolah</h6>
                                    <p class="text-muted card-sub-title">Isilah data dengan sebenar - benarnya</p>
                                </div>
                                <form id="registrationForm" action="{{ route('post_register') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div id="wizard3">
                                        <h3>Daftar Admin</h3>
                                        <section>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Username</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    Username sudah ada
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Password</label>
                                                <input class="form-control " required="" type="password" name="password">
                                            </div>
                                        </section>
                                        <section>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Nama Sekolah</label>
                                                <input class="form-control" required="" type="text" name="nama_sekolah">
                                            </div>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Alamat</label>
                                                <input class="form-control" required="" type="text" name="alamat" >
                                            </div>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Telepon</label>
                                                <input class="form-control" required="" type="number" name="telepon">
                                            </div>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Email</label>
                                                <input class="form-control" required="" type="email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label class="main-content-label tx-11 tx-medium tx-gray-600">Logo Sekolah</label>
                                                <input type="file" class="dropify" name="logo">
                                            </div>
                                        </section>
                                        <h3>Informasi Sekolah</h3>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery/jquery.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sidemenu/sidemenu.js" id="leftmenu"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sidebar/sidebar.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/select2/js/select2.min.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery-steps/jquery.steps.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/form-wizard.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fileuploads/js/file-upload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/fancy-uploader.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/sticky.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/themeColors-71fc6433.js"/>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/apexcharts.common-ba7e62a5.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/themeColors-71fc6433.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/app-53348e21.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/app-53348e21.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/switcher-4de6c754.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/switcher-4de6c754.js"></script>

</body>
</html>
