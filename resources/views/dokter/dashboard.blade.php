@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard <span class="right badge bg-info">Dokter</span></p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.periksa') }}" class="nav-link">
                <i class="nav-icon fas fa-stethoscope"></i>
                <p>Memeriksa <span class="right badge bg-info">Dokter</span></p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.jadwalPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>Jadwal Periksa <span class="right badge bg-info">Dokter</span></p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.historyPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>History Periksa <span class="right badge bg-info">Dokter</span></p>
            </a>
        </li>
    </ul>

    <!-- Logout Button -->
    <div class="d-flex justify-content-center mt-4">
        <form action="{{ route('logout') }}" method="POST" class="w-75 text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-block">Logout</button>
        </form>
    </div>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="m-0">Dashboard Dokter</h1>
                </div>
            </div>

            <!-- Statistik Box -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-5 col-lg-4">
                    <div class="small-box bg-info">
                        <div class="inner text-center">
                            <h3>{{$totalPeriksa}}</h3>
                            <p>Total yang Sudah Diperiksa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="small-box bg-success">
                        <div class="inner text-center">
                            <h3>{{$totalBelumDiPeriksa}}<sup style="font-size: 16px"> ORANG</sup></h3>
                            <p>Belum Diperiksa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer text-center">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            @if(session('welcome_message'))
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-check"></i>
                            {{ session('welcome_message') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Section -->
            @if(Auth::check())
                <div class="row justify-content-center mt-4">
                    <div class="col-12 col-lg-10">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user-md mr-2"></i> Biodata Dokter</h3>
                            </div>
                            <div class="card-body p-4">
                                <div class="row row-cols-1 row-cols-md-2">
                                    <div class="col mb-3">
                                        <div class="form-group">
                                            <label class="text-bold">ID Dokter:</label>
                                            <p class="text-muted">{{ Auth::user()->id }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">No. KTP:</label>
                                            <p class="text-muted">{{ Auth::user()->no_ktp }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">Nama Lengkap:</label>
                                            <p class="text-muted">{{ Auth::user()->name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">Email:</label>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col mb-3">
                                        <div class="form-group">
                                            <label class="text-bold">No. HP:</label>
                                            <p class="text-muted">{{ Auth::user()->no_hp }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">Alamat:</label>
                                            <p class="text-muted">{{ Auth::user()->alamat }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">Status:</label>
                                            <span class="badge badge-success">Aktif</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-bold">Poli:</label>
                                            <p class="text-muted">{{ Auth::user()->poli->nama_poli }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('dokter.dashboardEdit', ['id' => Auth::user()->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-edit mr-1"></i> Edit Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
