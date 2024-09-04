@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Profile Sekolah</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_sekolah') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <input type="hidden" name="current_logo" value="{{ $data->logo }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Sekolah</label>
                                        <input class="form-control" name="nama" required="" type="text" value="{{ $data->nama }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Alamat</label>
                                        <input class="form-control" name="alamat" required="" type="text" value="{{ $data->alamat }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Telepon</label>
                                        <input class="form-control" name="tlp" required="" type="text" value="{{ $data->tlp }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Email</label>
                                        <input class="form-control" name="email" required="" type="text" value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Logo</label>
                                        <input type="file" class="dropify" name="logo">
                                        <label>*Abaikan jika logo sudah sesuai</label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn ripple btn-main-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
