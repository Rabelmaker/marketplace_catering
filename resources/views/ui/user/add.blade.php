@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Tambah User</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_user') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="add">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama</label>
                                        <input class="form-control" name="Name" required type="text">
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
                                                <option value="Laki-laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tempat Lahir</label>
                                        <input class="form-control" name="Native" required type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Tanggal Lahir</label>
                                        <input class="form-control" name="Birthday" required type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Alamat</label>
                                        <input class="form-control" name="Address" required type="text">
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
                                                <option value="Guru">Guru</option>
                                                <option value="Siswa">Siswa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Kelas User</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach($datas as $data)
                                                    <option value="{{$data->id}}">{{$data->kelas}}</option>
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
                                        <input class="form-control" name="Notes" required type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">No. Hp</label>
                                        <input class="form-control" name="Telnum" required type="text">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">NIS/NIP</label>
                                        <input class="form-control" name="no_induk" required type="number"
                                               maxlength=11 placeholder="Maksimal 11 angka">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="dropify" name="picinfo" data-height="200" required>
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
