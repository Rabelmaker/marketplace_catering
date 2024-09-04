@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Laporan Keseluruhan</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Keseluruhan</li>
            </ol>
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
                                <th>Tanggal</th>
                                <th>Uraian</th>
                                <th>Uang Masuk</th>
                                <th>Uang Keluar</th>
                                <th>ADM Bank</th>
                                <th>Saldo Akhir</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_project }}</td>
                                    <td>{{ $data->tgl }}</td>
                                    <td>{{ $data->uraian }}</td>
                                    <td>@if($data->isMasuk == '1' )
                                            {{'Rp ' . number_format($data->total, 0, ',', '.')}}
                                        @else
                                            -
                                        @endif</td>
                                    <td>@if($data->isMasuk == '0' )
                                            {{'Rp ' . number_format($data->total, 0, ',', '.')}}
                                        @else
                                            -
                                        @endif</td>
                                    <td>{{'Rp ' . number_format($data->adm_bank, 0, ',', '.')}}</td>
                                    <td>{{'Rp ' . number_format($data->saldo_akhir, 0, ',', '.')}}</td>
                                    <td>{{ strip_tags($data->ket) }}</td>
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

