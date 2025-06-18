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
           <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Dashboard Dokter</h1>
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
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <h3 class="text-2xl font-bold tracking-tight">
                        <i class="fas fa-user-md mr-2"></i> Biodata Dokter
                    </h3>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">ID Dokter</label>
                                <p class="text-gray-600">{{ Auth::user()->id }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">No. KTP</label>
                                <p class="text-gray-600">{{ Auth::user()->no_ktp }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                                <p class="text-gray-600">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">Email</label>
                                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">No. HP</label>
                                <p class="text-gray-600">{{ Auth::user()->no_hp }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">Alamat</label>
                                <p class="text-gray-600">{{ Auth::user()->alamat }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">Status</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                    <i class="fas fa-check mr-1"></i> Aktif
                                </span>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700">Poli</label>
                                <p class="text-gray-600">{{ Auth::user()->poli->nama_poli }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50 border-t text-right">
                    <a href="{{ route('dokter.dashboardEdit', ['id' => Auth::user()->id]) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition transform duration-200">
                        <i class="fas fa-edit mr-2"></i> Edit Profil
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Include Tailwind CSS, Font Awesome, and Animation -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection
