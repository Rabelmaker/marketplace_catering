@extends('layout.layout')
@section('content')
    <div class="inner-body pt-0 error-bg">

        <!-- Row -->
        <div class="row sidemenu-height">
            <div class="col-md-12">
                <div class="construction1 text-center details">
                    <div class="">
                        <div class="col-lg-12">
                            <h1 class="tx-140 mb-0">500</h1>
                        </div>
                        <div class="col-lg-12 ">
                            <h1>Oops.Alat kemungkinan tidak terkoneksi</h1>
                            <h6 class="tx-15 mt-3 mb-4 text-muted">Pastikan alat terkoneksi dengan baik, jika sudah cobalah refresh kembali</h6>
                            <a class="btn ripple btn-success text-center mb-2" href="{{route('user')}}">Refresh</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

    </div>
@endsection
