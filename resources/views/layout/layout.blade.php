@php
    use Illuminate\Support\Facades\Route;
@endphp

    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from laravelui.spruko.com/spruha/index by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 11 May 2024 07:53:44 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Spruha - Laravel Bootstrap5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin dasboard, admin panel, dashboard, template dashboard, laravel template, bootstrap admin template, bootstrap 5 admin template, dashboard template bootstrap, laravel vite, laravel admin dashboard, bootstrap dashboard, laravel dashboard, admin panel design, vite laravel, admin dashboard bootstrap">

    <!-- TITLE -->
    <title>
        @if (Route::CurrentRouteName() == 'role')
            Data Role
        @elseif (Route::CurrentRouteName() == 'user')
            Data User
        @elseif (Route::CurrentRouteName() == 'device')
            Data Device
        @elseif (Route::CurrentRouteName() == 'setabsen')
            Data Setting Absen
        @endif
    </title>

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

    <!-- Croppie CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">


</head>

<body class="ltr main-body leftmenu">

<!-- LOADER -->
<div id="global-loader">
    <img src="{{asset('theme/spruha')}}/build/assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- END LOADER -->

<!-- PAGE -->
<div class="page">

    <!-- HEADER -->

    <div class="main-header side-header sticky">
        <div class="main-container container-fluid">
            <div class="main-header-left">
                <a class="main-header-menu-icon" href="javascript:void(0);" id="mainSidebarToggle"><span></span></a>
                <div class="hor-logo">
                    <a class="main-logo" href="index.html">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/label.png"
                             class="header-brand-img desktop-logo" alt="logo">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelputih.png"
                             class="header-brand-img desktop-logo-dark"
                             alt="logo">
                    </a>
                </div>
            </div>
            <div class="main-header-center">
                <div class="responsive-logo">
                    <a href="{{\route('dashboard')}}"><img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelaja.png"
                                              class="mobile-logo" height="40px" alt="logo"></a>
                    <a href="{{\route('dashboard')}}"><img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelaja.png"
                                              class="mobile-logo-dark" height="40px"
                                              alt="logo"></a>
                </div>
            </div>
            <div class="main-header-right">
                <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                </button><!-- Navresponsive closed -->
                <div
                    class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="main-header-right">
                            <!-- Search -->
                            <div class="dropdown header-search">
                                <a class="nav-link icon header-search">
                                    <i class="fe fe-search header-icons"></i>
                                </a>
                            </div>
                            <!-- Search -->
                            <!-- Theme-Layout -->
                            <div class="dropdown main-header-theme">
                                <a class="nav-link icon layout-setting">
                                            <span class="dark-layout">
                                                <i class="fe fe-sun header-icons"></i>
                                            </span>
                                    <span class="light-layout">
                                                <i class="fe fe-moon header-icons"></i>
                                            </span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->
                            <!-- Full screen -->
                            <div class="dropdown ">
                                <a class="nav-link icon full-screen-link">
                                    <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                                    <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                                </a>
                            </div>
                            <!-- Full screen -->
                            <!-- Profile -->
                            <div class="dropdown main-profile-menu">
                                <a class="" href="javascript:void(0);">
                                            <span class="main-img-user"><img alt="avatar"
                                                                             src="{{ asset($dataSekolah->logo) }}"></span>
                                </a>
                                <div class="dropdown-menu">
                                    <div class="header-navheading">
                                        <h6 class="main-notification-title">{{$dataSekolah->nama}}</h6>
                                        <p class="main-notification-text">Welcome</p>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('gantipassword', $dataSekolah->id_admin) }}">
                                        <i class="fe fe-lock"></i> Ganti Password
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="logout()">
                                        <i class="fe fe-power"></i> Sign Out
                                    </a>
                                </div>
                            </div>
                            <!-- Profile -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER -->

    <!-- SIDEBAR -->

    <div class="sticky">
        <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
            <div class="main-sidebar-header main-container-1 active">
                <div class="sidemenu-logo">
                    <a class="main-logo" href="{{\route('dashboard')}}">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelaja.png"
                             class="header-brand-img desktop-logo" height="40px" alt="logo">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelicon.png"
                             class="header-brand-img icon-logo" height="50" alt="logo">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/label.png"
                             class="header-brand-img desktop-logo theme-logo" alt="logo">
                        <img src="{{asset('theme/spruha')}}/build/assets/img/brand/labelicon.png"
                             class="header-brand-img icon-logo theme-logo" height="50" alt="logo">
                    </a>
                </div>
                <div class="main-sidebar-body main-body-1">
                    <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                    <ul class="menu-nav nav">
                        <li class="nav-header"><span class="nav-label">Home</span></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}">
                                <i class="ti-home sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-header"><span class="nav-label">Data</span></li>
                        <li class="nav-item">
                            <a class="nav-link with-sub" href="javascript:void(0);">
                                <i class="ti-server sidemenu-icon menu-icon "></i>
                                <span class="sidemenu-label">Input Data</span>
                                <i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub">
                                <li class="side-menu-label1"><a href="javascript:void(0);">Input Data</a></li>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('device')}}">Device</a>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('kelas')}}">Kelas</a>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('setabsen')}}">Setting Absen</a>
                                <li class="nav-sub-item"><a class="nav-sub-link" href="{{route('user')}}">User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="slide-right" id="slide-right"><i class="fe fe-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SIDEBAR -->

    <!-- MAIN-CONTENT -->
    <div class="main-content side-content pt-0">
        <div class="main-container container-fluid">
            @yield('content')
        </div>
    </div>

    <!-- END MAIN-CONTENT -->

    <!-- RIGHT-SIDEBAR -->

    <div class="sidebar sidebar-right sidebar-animate">
        <div class="sidebar-icon">
            <a href="javascript:void(0);" class="text-end float-end text-dark fs-20" data-bs-toggle="sidebar-right"
               data-bs-target=".sidebar-right"><i class="fe fe-x"></i></a>
        </div>
        <div class="sidebar-body">
            <h5>Todo</h5>
            <div class="d-flex p-3">
                <label class="ckbox"><input checked type="checkbox"><span>Hangout With friends</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input checked type="checkbox"><span>System Updated</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input type="checkbox"><span>Do something more</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input type="checkbox"><span>System Updated</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top">
                <label class="ckbox"><input type="checkbox"><span>Find an Idea</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <div class="d-flex p-3 border-top mb-0">
                <label class="ckbox"><input type="checkbox"><span>Project review</span></label>
                <span class="ms-auto">
                            <i class="fe fe-edit-2 text-primary me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Edit"></i>
                            <i class="fe fe-trash-2 text-danger me-2" data-bs-toggle="tooltip" title=""
                               data-bs-placement="top" data-bs-original-title="Delete"></i>
                        </span>
            </div>
            <h5>Overview</h5>
            <div class="p-4">
                <div class="main-traffic-detail-item">
                    <div>
                        <span>Founder &amp; CEO</span> <span>24</span>
                    </div>
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="20"
                             class="progress-bar progress-bar-xs wd-20p" role="progressbar"></div>
                    </div><!-- progress -->
                </div>
                <div class="main-traffic-detail-item">
                    <div>
                        <span>UX Designer</span> <span>1</span>
                    </div>
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="15"
                             class="progress-bar progress-bar-xs bg-secondary wd-15p" role="progressbar"></div>
                    </div><!-- progress -->
                </div>
                <div class="main-traffic-detail-item">
                    <div>
                        <span>Recruitment</span> <span>87</span>
                    </div>
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45"
                             class="progress-bar progress-bar-xs bg-success wd-45p" role="progressbar"></div>
                    </div><!-- progress -->
                </div>
                <div class="main-traffic-detail-item">
                    <div>
                        <span>Software Engineer</span> <span>32</span>
                    </div>
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25"
                             class="progress-bar progress-bar-xs bg-info wd-25p" role="progressbar"></div>
                    </div><!-- progress -->
                </div>
                <div class="main-traffic-detail-item">
                    <div>
                        <span>Project Manager</span> <span>32</span>
                    </div>
                    <div class="progress">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="25"
                             class="progress-bar progress-bar-xs bg-danger wd-25p" role="progressbar"></div>
                    </div><!-- progress -->
                </div>
            </div>
        </div>
    </div>
    <!-- END RIGHT-SIDEBAR -->

    <!-- FOOTER -->

    <div class="main-footer text-center">
        <div class="container">
            <div class="row row-sm">
                <div class="col-md-12">
                            <span>Copyright © <span id="year"></span> <a href="javascript:void(0);">Label</a>. Designed by <a
                                    href="javascript:void(0);" target="_blank">Annora Multi Intech</a> All rights reserved.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- END FOOTER -->

</div>
<!-- END PAGE-->

<!-- SCRIPTS -->

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<!-- JQUERY JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery/jquery.min.js"></script>

<!-- Croppie JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- PERFECT-SCROLLBAR JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- SIDEMENU JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sidemenu/sidemenu.js" id="leftmenu"></script>

<!-- SIDEBAR JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sidebar/sidebar.js"></script>

<!-- SELECT2 JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/select2/js/select2.min.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"></script>

<!-- INTERNAL CHART BUNDLE JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/chart.js/Chart.bundle.min.js"></script>

<!-- PEITY JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/peity/jquery.peity.min.js"></script>

<!-- INTERNAL MORRIS JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/morris.js/morris.min.js"></script>

<!-- CIRCLE PROGRESS JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/circle-progress/circle-progress.min.js"></script>

<!-- INTERNAL DASHBOARD JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/index-de57ff48.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/index-de57ff48.js"></script>

<!-- STICKY JS -->
<script src="{{asset('theme/spruha')}}/build/assets/sticky.js"></script>

<!-- THEMECOLORs JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/themeColors-71fc6433.js"/>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/apexcharts.common-ba7e62a5.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/themeColors-71fc6433.js"></script>

<!-- APP JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/app-53348e21.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/app-53348e21.js"></script>

<!-- SWITCHER JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/switcher-4de6c754.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/switcher-4de6c754.js"></script>

<!-- INTERNAL DATA TABLE JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/table-data-ed47eae9.js" /><script type="module" src="{{asset('theme/spruha')}}/build/assets/table-data-ed47eae9.js"></script>

<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js" /><script type="module" src="{{asset('theme/spruha')}}/build/assets/select2-278046b4.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    @if(session('sukses'))
    $(document).ready(function () {
        Swal.fire({
            title: 'Success',
            text: '{{ session('sukses') }}',
            type: 'success',
            showConfirmButton: false,
            timer: 3000,
            position: 'top-end',
        });
    });
    @endif
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
    function logout() {
        Swal.fire({
            title: 'Anda yakin !',
            text: "Akan keluar dari akun ini ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout'
        }).then((result) => {
            if (result.value) {
                var url = '{{ route('logout') }}';
                location.replace(url);
            }
        });
    }

    function reset_user() {
        Swal.fire({
            title: 'Anda yakin !',
            text: "Ingin mereset user ?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Reset'
        }).then((result) => {
            if (result.value) {
                Swal.fire({
                    title: 'Sedang mereset user...',
                    text: 'Mohon tunggu...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    showTimer: true,
                    didOpen: () => {
                        Swal.showLoading(); // Tampilkan animasi loading
                    }
                });

                $.ajax({
                    url: '{{ route('reset_user') }}',
                    success: function(response) {
                        Swal.close();

                        // Tangani respons dari server jika diperlukan
                        console.log(response);



                        Swal.fire({
                            title: 'Selesai!',
                            text: 'Proses Berhasil',
                            icon: 'success',
                            timer: 40000,
                            timerProgressBar: true,
                        }).then(() => {
                            window.location = "{{ \route('user') }}"
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat mereset user.',
                            icon: 'error'
                        });
                        console.error(error);
                    }
                });
            }
        });
    }

    function hapus(url, pesan) {
        Swal.fire({
            title: 'Anda yakin !!!',
            text: pesan,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                location.replace(url);
            }
        });
    }

    function verifikasi(url, pesan) {
        Swal.fire({
            title: 'Anda yakin !!!',
            text: pesan,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Verifikasi !'
        }).then((result) => {
            if (result.value) {
                location.replace(url);
            }
        });
    }


</script>

<!-- INTERNAL SWEET-ALERT JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/sweet-alert/jquery.sweet-alert.js"></script>

<!-- INTERNAL SUMMERNOTE EDITOR JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/summernote-editor/summernote1.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/summernote-8a8c9ed9.js"/>
<script type="module" src="{{asset('theme/spruha')}}/build/assets/summernote-8a8c9ed9.js"></script>

<!-- INTERNAL WYSIWYG EDITOR JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/wysiwyag/jquery.richtext.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/wysiwyag/wysiwyag.js"></script>

<!-- INTERNAL TELEPHONEINPUT JS -->
<script src="https://laravelui.spruko.com/spruha/build/assets/plugins/telephoneinput/telephoneinput.js"></script>
<script src="https://laravelui.spruko.com/spruha/build/assets/plugins/telephoneinput/inttelephoneinput.js"></script>

<!-- INTERNAL DATERANGEPICKER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- INTERNAL FILEUPLOADERS JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fileuploads/js/file-upload.js"></script>

<!-- INTERNALFANCY UPLOADER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
<script src="{{asset('theme/spruha')}}/build/assets/plugins/fancyuploder/fancy-uploader.js"></script>

<!-- INTERNAL FORM-ELEMENTS JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/advanced-form-elements-7a754ef0.js"/>
<script type="module"
        src="{{asset('theme/spruha')}}/build/assets/advanced-form-elements-7a754ef0.js"></script>

<!-- INTERNAL JQUERY-UI JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

<!-- INTERNAL JQUERY.MASKEDINPUT JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/jquery.maskedinput/jquery.maskedinput.js"></script>

<!-- INTERNAL SPECTURM-COLORPICKER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/spectrum-colorpicker/spectrum.js"></script>

<!-- INTERNAL ION-RANGESLIDER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>

<!-- INTERNAL FORM-ELEMENTS JS -->
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/form-elements-9e2a0bab.js" /><script type="module" src="{{asset('theme/spruha')}}/build/assets/form-elements-9e2a0bab.js"></script>

<!-- BOOTSTRAP-DATEPICKER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

<!-- INTERNAL JQUERY-SIMPLE-DATETIMEPICKER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js"></script>

<!-- COLOR PICKER JS -->
<script src="{{asset('theme/spruha')}}/build/assets/plugins/pickr-master/pickr.es5.min.js"></script>
<link rel="modulepreload" href="{{asset('theme/spruha')}}/build/assets/picker-002134b6.js" /><script type="module" src="{{asset('theme/spruha')}}/build/assets/picker-002134b6.js"></script>


<script>
    // Fungsi untuk menghitung jumlah secara real-time
    function hitungJumlah() {
        var volume = parseFloat(document.getElementById('volume').value);
        var harga = parseFloat(document.getElementById('harga').value);
        var adm_bank = parseFloat(document.getElementById('adm_bank').value);

        var jumlah = (volume * harga) + adm_bank;

        // Menyimpan nilai jumlah ke input jumlah
        document.getElementById('jumlah').value = jumlah.toFixed(0); // Menyimpan nilai jumlah dengan dua digit di belakang koma
    }

    // Menambahkan event listener untuk input volume, harga, dan ADM bank
    document.getElementById('volume').addEventListener('input', hitungJumlah);
    document.getElementById('harga').addEventListener('input', hitungJumlah);
    document.getElementById('adm_bank').addEventListener('input', hitungJumlah);

    // Memanggil fungsi hitungJumlah saat halaman dimuat (jika perlu)
    window.onload = function () {
        hitungJumlah();
    };
</script>
<script>
    $(document).ready(function () {
        var croppieDemo = $('#croppie-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        var fileInput = $('input[name="picinfo"]');
        var cropModal = $('#cropModal');
        var croppedImage = null;

        fileInput.on('change', function () {
            var reader = new FileReader();
            reader.onload = function (e) {
                croppieDemo.croppie('bind', {
                    url: e.target.result
                });
                cropModal.modal('show');
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#cropImageBtn').on('click', function () {
            croppieDemo.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (resp) {
                croppedImage = resp;
                cropModal.modal('hide');
            });
        });

        $('form').on('submit', function (e) {
            if (croppedImage) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'cropped_image',
                    value: croppedImage
                }).appendTo('form');
            }
        });
    });
</script>


<!-- END SCRIPTS -->

</body>

</html>
