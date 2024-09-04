@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Data Uang Masuk dan Keluar</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Uang Masuk dan Keluar</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <a href="{{ route('add_uangMasuk') }}">
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
                        <table id="exportexample" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Project</th>
                                <th>Jumlah Uang</th>
                                <th>Tanggal Masuk</th>
                                <th>Keterangan</th>
                                <th>Kwitansi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_project }}</td>
                                    <td>{{ 'Rp ' . number_format($data->total, 0, ',', '.') }}</td>
                                    <td>{{ $data->tgl }}</td>
                                    <td>{{ strip_tags($data->ket) }}</td>
                                    <td>
                                        @if($data->lampiran>0)
                                            <a href="{{ asset($data->lampiran) }}" download>Unduh File</a>
                                        @else
                                            <p style="color: red">Tidak Ada Lampiran</p>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

@endsection

