@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Data Absen</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Absen</li>
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
                        <a class="dropdown-item" href="{{ route('absenharian', $kelas->id) }}">{{ $kelas->kelas }}</a>
                    @endforeach
                </div>
            </div>
            <div class="justify-content-center">
                <form method="GET" action="{{ route('absenharian', $currentKelasId) }}">
                    <div class="input-group">
                        <input type="date" class="form-control pull-right" name="date"
                               placeholder="Tanggal" value="{{ request('date') }}">
                        <button class="btn ripple btn-primary btn-icon" type="submit">
                            <i class="fe fe-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Absen Masuk</h6>
                        <p class="text-muted card-sub-title">Isi manual absen jika murid belum absen atau tidak
                            masuk.</p>
                    </div>
                    <div class="table-responsive">
                        <table id="exportexample1" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIS/NIP</th>
                                <th>Waktu Absen</th>
                                <th>Status Absen</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($absens as $absen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $absen->Name }}</td>
                                    <td>{{ $absen->no_induk }}</td>
                                    <td>@if($absen->created_at != null)
                                            {{\App\Helpers\Kamus::tgl_jam_indo($absen->created_at)}}
                                        @else
                                            -
                                        @endif</td>
                                    <td>@if($absen->absen != null)
                                            {{ $absen->absen }}
                                        @else
                                            -
                                        @endif</td>
                                    <td>
                                        @if($absen->id != null)
                                            <a href="{{ route('edit_absenharian', $absen->id) }}">
                                                <button type="button"
                                                        class="btn btn-outline-primary my-2 btn-icon-text">
                                                    <i class="fe fe-edit-2"></i>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('add_absenharian', $absen->id_user) }}">
                                                <button type="button"
                                                        class="btn btn-outline-success my-2 btn-icon-text">
                                                    <i class="fe fe-user-plus"></i>
                                                </button>
                                            </a>
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
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <h6 class="main-content-label mb-1">Absen Pulang</h6>
                    <p class="text-muted card-sub-title">Isi manual absen jika murid belum absen atau tidak masuk.</p>
                    <div class="table-responsive">
                        <table id="exportexample2" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NIS/NIP</th>
                                <th>Waktu Absen</th>
                                <th>Status Absen</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($absensPulang as $pulang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pulang->Name }}</td>
                                    <td>{{ $pulang->no_induk }}</td>
                                    <td>@if($pulang->created_at != null)
                                            {{\App\Helpers\Kamus::tgl_jam_indo($pulang->created_at)}}
                                        @else
                                            -
                                        @endif</td>
                                    <td>@if($pulang->absen != null)
                                            {{ $pulang->absen }}
                                        @else
                                            -
                                        @endif</td>
                                    <td>
                                        @if($pulang->id != null)
                                            <a href="{{ route('edit_absenharian', $pulang->id) }}">
                                                <button type="button"
                                                        class="btn btn-outline-primary my-2 btn-icon-text">
                                                    <i class="fe fe-edit-2"></i>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('add_absenharian', $pulang->id_user) }}">
                                                <button type="button"
                                                        class="btn btn-outline-success my-2 btn-icon-text">
                                                    <i class="fe fe-user-plus"></i>
                                                </button>
                                            </a>
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
