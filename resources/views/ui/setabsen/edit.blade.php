@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit Setting Absen</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Setting Absen</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_setabsen') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Hari</label>
                                        <select class="form-control select2" name="hari">
                                            <option value="">Pilih Hari</option>
                                            <option @if($data->hari === "Senin") selected @endif value="Senin">Senin</option>
                                            <option @if($data->hari === "Selasa") selected @endif value="Selasa">Selasa</option>
                                            <option @if($data->hari === "Rabu") selected @endif value="Rabu">Rabu</option>
                                            <option @if($data->hari === "Kamis") selected @endif value="Kamis">Kamis</option>
                                            <option @if($data->hari === "Jumat") selected @endif value="Jumat">Jumat</option>
                                            <option @if($data->hari === "Sabtu") selected @endif value="Sabtu">Sabtu</option>
                                            <option @if($data->hari === "Minggu") selected @endif value="Minggu">Minggu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Rentang Awal Absen Masuk</label>
                                        <input class="form-control" name="masuk_awal" required="" type="time" value="{{$data->masuk_awal}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Rentang Akhir Absen Masuk</label>
                                        <input class="form-control" name="masuk_akhir" required="" type="time" value="{{$data->masuk_akhir}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Toleransi Keterlambatan</label>
                                        <input class="form-control" name="terlambat" required="" type="number" value="{{$data->terlambat}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Absen Pulang</label>
                                        <input class="form-control" name="absen_pulang" required="" type="time" value="{{$data->pulang}}">
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
