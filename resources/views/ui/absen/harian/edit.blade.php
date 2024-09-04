@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Status Absen</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Status Absen</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_absenharian') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="edit" value="{{ $data->id }}">
                        <input type="hidden" name="id_kelas" value="{{ $data->id_kelas }}"> <!-- Tambahkan hidden input untuk ID kelas -->
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama</label>
                                        <input class="form-control" name="Name" required="" type="text" disabled value="{{ $data->Name }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">NIS/NIP</label>
                                        <input class="form-control" name="no_induk" required="" type="text" disabled value="{{ $data->no_induk }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Waktu Absen</label>
                                        <input class="form-control" name="created_at" required="" type="text" disabled value="{{ \App\Helpers\Kamus::tgl_jam_indo($data->created_at) }}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="">Status Absen</label>
                                    <select class="form-control select2" name="absen">
                                        <option value="">Status Absen</option>
                                        <option @if($data->absen === "Tepat Waktu") selected @endif value="Tepat Waktu">Tepat Waktu</option>
                                        <option @if($data->absen === "Terlambat") selected @endif value="Terlambat">Terlambat</option>
                                        <option @if($data->absen === "Alpha") selected @endif value="Alpha">Alpha</option>
                                        <option @if($data->absen === "Izin") selected @endif value="Izin">Izin</option>
                                        <option @if($data->absen === "Sakit") selected @endif value="Sakit">Sakit</option>
                                    </select>
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
