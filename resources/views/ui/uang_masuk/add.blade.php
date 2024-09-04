@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Tambah Uang Masuk dan Keluar</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Uang Masuk dan Keluar</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_uangMasuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="add">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Jumlah Uang</label>
                                        <input class="form-control" name="total" required="" type="number">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Project</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_project">
                                                <option value="">Select Penanggung Jawab</option>
                                                @foreach($datas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama_project }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Laporan</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_laporan">
                                                <option value="">Pilih Laporan</option>
                                                @foreach($laporans as $laporan)
                                                    <option value="{{ $laporan->id }}">{{ $laporan->nama_laporan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="form-group">
                                    <label class="">Jenis Transaksi</label>
                                    <div class="form-group ">
                                        <select class="form-control select2" name="isMasuk">
                                            <option value="">Select Transaksi</option>
                                            <option value="1">Uang Masuk</option>
                                            <option value="0">Uang Keluar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Masuk</label>
                                        <input class="form-control" name="tgl" required="" type="date">
                                    </div>
                                </div>
                            </div>
                            <label class="">Keterangan</label>
                            <div>
                                <textarea class="content5" name="ket"></textarea>
                            </div>
                            <label class="mt-3">Upload Kwitansi</label>
                            <div class="col-sm-12 col-md-12 ">
                                <input type="file" class="dropify" name="lampiran">
                            </div>
                        </div>
                        <br>
                        <button class="btn ripple btn-main-primary btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
