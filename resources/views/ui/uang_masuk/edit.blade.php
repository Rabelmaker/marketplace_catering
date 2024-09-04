@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Uang Masuk dan Keluar</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Uang Masuk dan Keluar</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_uangMasuk') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Uang Masuk dan Keluar</label>
                                        <input class="form-control" name="total" required="" type="number"
                                               value="{{$data->total}}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Project</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_project">
                                                <option value="">Select Penanggung Jawab</option>
                                                @foreach($projects as $item)
                                                    <option @if($item->id == $data->id_project) selected
                                                            @endif value="{{ $item->id }}">{{ $item->nama_project }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">ADM Bank</label>
                                        <input class="form-control" name="adm_bank" required="" type="number"
                                               value="{{$data->adm_bank}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Masuk</label>
                                        <input class="form-control" name="tgl" required="" type="date"
                                               value="{{$data->tgl}}">
                                    </div>
                                </div>
                            </div>
                            <label class="">Keterangan</label>
                            <div>
                                <textarea class="content5" name="ket">{{$data->ket}}</textarea>
                            </div>
                            <label class="mt-3">Upload Kwitansi</label>
                            <div class="col-sm-12 col-md-12 ">
                                <input type="file" class="dropify" name="lampiran">
                                <p style="color: red">Note : Abaikan jika tidak diubah</p>
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
