@extends('layout.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <div class="row square">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="panel profile-cover">
                        <div class="btn-profile">
                            <a href="{{ route('edit_sekolah', $dataSekolah->id) }}">
                                <button class="btn btn-rounded btn-success">
                                    <i class="fa fa-edit"></i>
                                    <span>Edit Profile</span>
                                </button>
                            </a>
                        </div>
                        <div class="profile-cover__action bg-img">
                            <div class="profile-cover__img">
                                <img src="{{$dataSekolah->logo}}" alt="img" height="115px">
                            </div>
                        </div>
                        <div class="profile-cover__spacer"></div> <!-- Spacer to maintain layout size -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card main-content-body-profile">
                <div class="tab-content">
                    <div class="main-content-body tab-pane p-4 border-top-0 active" id="about">
                        <div class="card-body p-0 border p-0 rounded-10">
                            <div class="p-4">
                                <div class="mg-sm-r-20 mg-b-10">
                                    <div class="media-body"><span class="text-secondary">Nama Sekolah</span>
                                        <h3 class="text-primary"> {{$dataSekolah->nama}}</h3>
                                    </div>
                                </div>
                                <div class="border-top"></div>
                                <label class="main-content-label tx-13 mg-b-20 mt-3">Contact</label>
                                <div class="d-flex flex-column flex-md-row flex-lg-row">
                                    <div class="mg-md-r-20 mg-b-10">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-primary-transparent text-primary">
                                                    <i class="icon ion-md-phone-portrait"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Telepon</span>
                                                    <div> {{ \App\Helpers\Kamus::no_hp($dataSekolah->tlp) }} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mg-md-r-20 mg-b-10">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-success-transparent text-success">
                                                    <i class="icon ion-md-mail-unread"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Email</span>
                                                    <div> {{$dataSekolah->email}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mg-md-r-20 mg-b-10">
                                        <div class="main-profile-contact-list">
                                            <div class="media">
                                                <div class="media-icon bg-info-transparent text-info">
                                                    <i class="icon ion-md-locate"></i>
                                                </div>
                                                <div class="media-body">
                                                    <span>Alamat</span>
                                                    <div> {{$dataSekolah->alamat}} </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div>
                        <h6 class="main-content-label mb-1">Absen Sekolah</h6>
                    </div>
                    <div class="border-top mb-4 mt-3"></div>
                    <div class="table-responsive">
                        <table id="example3" class="table table-striped table-bordered text-nowrap">
                            <thead>
                            <tr>
                                <th class="col-1">No.</th>
                                <th class="col-8">Kelas</th>
                                <th class="col-3">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataKelas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('absenharian', $data->id) }}">
                                                <button class="btn ripple btn-success btn-with-icon">
                                                    <i class="fe fe-clock"></i> Absen Harian
                                                </button>
                                            </a>
                                            <a href="{{ route('absenrekap', $data->id) }}">
                                                <button class="btn ripple btn-primary btn-with-icon">
                                                    <i class="fe fe-calendar"></i> Rekap Absen
                                                </button>
                                            </a>
                                        </div>
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

@endsection
