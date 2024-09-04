@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Data Rekap</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Rekap</li>
            </ol>
        </div>
        <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
            <div class="justify-content-center">
                @php
                    $currentKelasId = request()->route('id');
                    $currentKelas = $kelass->firstWhere('id', $currentKelasId);
                @endphp
                <button class="btn ripple btn-success dropdown-toggle" data-bs-toggle="dropdown">
                    {{ $currentKelas ? $currentKelas->kelas : 'Pilih Kelas' }}
                    <i class="icon ion-ios-arrow-down tx-11 mg-l-3"></i>
                </button>
                <div class="dropdown-menu">
                    @foreach($kelass as $kelas)
                        <a class="dropdown-item" href="{{ route('absenrekap', $kelas->id) }}">{{ $kelas->kelas }}</a>
                    @endforeach
                </div>
            </div>
            <div class="justify-content-center">
                <form method="GET" action="{{ route('absenrekap', $currentKelasId) }}">
                    <div class="input-group">
                        <input type="date" class="form-control pull-right" name="start_date"
                               placeholder="Tanggal Mulai" value="{{ request('start_date') }}">
                        <input type="date" class="form-control pull-right" name="end_date"
                               placeholder="Tanggal Selesai" value="{{ request('end_date') }}">

                        <button class="btn ripple btn-primary btn-icon" type="submit">
                            <i class="fe fe-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Baris -->
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
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Alpha</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->Name }}</td>
                                    <td>{{ $user->no_induk }}</td>
                                    <td>{{ $user->total_hadir }}</td>
                                    <td>{{ $user->total_izin }}</td>
                                    <td>{{ $user->total_sakit }}</td>
                                    <td>{{ $user->total_alpha }}</td>
                                    <td>{{ $user->total_hadir + $user->total_izin + $user->total_sakit + $user->total_alpha }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Baris -->
@endsection
