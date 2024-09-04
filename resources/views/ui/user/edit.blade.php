@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Edit User</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama</label>
                                        <input class="form-control" name="Name" required type="text"
                                               value="{{ $data->Name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Gender</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="Gender" required>
                                                <option value="">Pilih Gender</option>
                                                <option @if($data->Gender === "Laki-laki") selected @endif value="Laki-laki">Laki - Laki
                                                </option>
                                                <option @if($data->Gender === "Perempuan") selected @endif value="Laki-laki">Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tempat Lahir</label>
                                        <input class="form-control" name="Native" required type="text"
                                               value="{{ $data->Native }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Lahir</label>
                                        <input class="form-control" name="Birthday" required type="date"
                                               value="{{ $data->Birthday }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Alamat</label>
                                        <input class="form-control" name="Address" required type="text"
                                               value="{{ $data->Address }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Role User</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="role" required>
                                                <option value="">Pilih Role</option>
                                                <option @if($data->role === 'Guru') selected
                                                        @endif value="Guru">Guru
                                                </option>
                                                <option @if($data->role === 'Siswa') selected @endif value="Siswa">
                                                    Siswa
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Kelas</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach($datakelas as $kelas)
                                                    <option @if($data->id_kelas === $kelas->id) selected
                                                            @endif value="{{$kelas->id}}">
                                                        {{$kelas->kelas}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Keterangan</label>
                                        <input class="form-control" name="Notes" required type="text"
                                               value="{{ $data->Notes }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">No. Hp</label>
                                        <input class="form-control" name="Telnum" required type="text"
                                               value="{{ $data->Telnum }}">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">NIS/NIP</label>
                                        <input class="form-control" name="no_induk" required type="number"
                                               value="{{ $data->no_induk }}" maxlength="11"
                                               placeholder="Maksimal 11 angka">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="dropify" name="picinfo" required>
                                    </div>
                                </div>

                                <button class="btn ripple btn-main-primary btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="cropModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="croppie-demo"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="cropImageBtn">Crop</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
