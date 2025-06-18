@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <span class="right badge bg-info">Dokter</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.periksa') }}" class="nav-link">
                <i class="nav-icon fas fa-stethoscope"></i>
                <p>
                    Memeriksa
                    <span class="right badge bg-info">Dokter</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.jadwalPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Jadwal Periksa
                    <span class="right badge bg-info">Dokter</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dokter.historyPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    History Periksa
                    <span class="right badge bg-info">Dokter</span>
                </p>
            </a>
        </li>
    </ul>

    <!-- Brand Logo or Logout Section -->
    <div class="d-flex justify-content-center mt-4">
        <form action="{{ route('logout') }}" method="POST" class="w-75 text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-medium btn-block">
                Logout
            </button>
        </form>
    </div>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">History Periksa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">History Periksa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
   <section class="content py-8 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 animate-fade-in">
            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <h3 class="text-2xl font-bold tracking-tight">
                    <i class="fas fa-folder-open mr-2"></i> Riwayat Pemeriksaan Pasien
                </h3>
            </div>
            <div class="p-6 sm:p-8">
                @if($periksas->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 text-gray-800">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">No</th>
                                    <th class="p-4 text-sm font-semibold">Nama Pasien</th>
                                    <th class="p-4 text-sm font-semibold">Tanggal Periksa</th>
                                    <th class="p-4 text-sm font-semibold">Keluhan</th>
                                    <th class="p-4 text-sm font-semibold">Catatan Dokter</th>
                                    <th class="p-4 text-sm font-semibold">Obat</th>
                                    <th class="p-4 text-sm font-semibold">Biaya Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periksas as $index => $periksa)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm font-medium">{{ $index + 1 }}</td>
                                        <td class="p-4 text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-user-injured text-blue-600 mr-3 text-lg"></i>
                                                <span class="font-semibold">{{ $periksa->pasien->name }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d/m/Y H:i') }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <span class="text-gray-700">{{ $periksa->janjiPeriksa->keluhan ?? '-' }}</span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <span class="text-gray-700">{{ $periksa->catatan ?? '-' }}</span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            @if($periksa->obat->count() > 0)
                                                <ul class="space-y-2">
                                                    @foreach($periksa->obat as $obat)
                                                        <li class="flex justify-between items-center">
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 shadow-sm">
                                                                {{ $obat->nama_obat }} ({{ $obat->kemasan }})
                                                            </span>
                                                            <span class="text-sm font-semibold text-green-600">
                                                                Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-gray-500 italic">-</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm">
                                            <span class="font-semibold text-green-600">
                                                Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 animate-fade-in">
                        <div class="mb-6">
                            <i class="fas fa-folder-open text-7xl text-gray-300 animate-pulse"></i>
                        </div>
                        <h4 class="text-2xl font-semibold text-gray-700">Belum Ada Riwayat Pemeriksaan</h4>
                        <p class="text-gray-500 mt-2">Data pemeriksaan akan muncul setelah Anda melakukan pemeriksaan pasien.</p>
                    </div>
                @endif
            </div>
            @if(method_exists($periksas, 'hasPages') && $periksas->hasPages())
                <div class="p-6 bg-gray-50 border-t">
                    {{ $periksas->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Include Tailwind CSS and Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

@push('scripts')
    <script>
        $(document).ready(function () {
            // Initialize DataTable if you want to add search/sort functionality
            // $('.table').DataTable({
            //     "responsive": true,
            //     "lengthChange": false,
            //     "autoWidth": false,
            // });
        });
    </script>
@endpush