@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Tambah Project</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Project</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('post_project') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="add">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Project</label>
                                        <input class="form-control" name="nama_project" required="" type="text">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Nama Penanggung Jawab</label>
                                        <div class="form-group ">
                                            <select class="form-control select2" name="id_pj">
                                                <option value="">Select Penanggung Jawab</option>
                                                @foreach($datas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">

                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Mulai Project</label>
                                        <input class="form-control" name="start_project" required="" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Deadline Project</label>
                                        <input class="form-control" name="end_project" required="" type="date">
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
