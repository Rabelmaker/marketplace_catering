@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Data User</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                @if($can_sync)
                    <a href="{{ route('sync_user') }}">
                        <button type="button" class="btn btn-primary btn-icon-text my-2 me-2">
                            <i class="fe fe-server me-2"></i> Sinkron Data
                        </button>
                    </a>
                @endif
                <a href="{{ route('add_user') }}">
                    <button type="button" class="btn btn-success my-2 btn-icon-text">
                        <i class="fe fe-file-plus me-2"></i> Tambah Data
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample1" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIS/NIP</th>
                                <th>Gender</th>
                                <th>Photo</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->Name }}</td>
                                    <td>{{ $data->no_induk }}</td>
                                    <td>@if($data->Gender == 0)
                                            Laki - Laki
                                        @else
                                            Perempuan
                                        @endif</td>
                                    <td>
                                        @if(isset($data->picinfo))
                                            <img src="{{ $data->picinfo }}" alt="Photo"
                                                 style="width: 100px; height: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delete_user', $data->id) }}">
                                            <button type="button" class="btn btn-outline-danger my-2 btn-icon-text">
                                                <i class="fe fe-trash-2"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('edit_user', $data->id) }}">
                                            <button type="button"
                                                    class="btn btn-outline-primary my-2 btn-icon-text">
                                                <i class="fe fe-edit-2"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <a href="javascript:void(0);" onclick="reset_user()">
                    <button type="button" class="btn btn-danger btn-icon-text">
                        <i class="fe fe-trash-2 me-2"></i> Reset Data Alat
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
