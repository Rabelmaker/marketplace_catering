@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Laporan</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Laporan</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_grupLap') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Laporan</label>
                                        <input class="form-control" name="nama_laporan" required="" type="text" value="{{$data->nama_laporan}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Keterangan</label>
                                        <input class="form-control" name="ket" required="" type="text" value="{{$data->ket}}">
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
