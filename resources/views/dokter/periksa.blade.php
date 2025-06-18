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

@section('title', 'Daftar Pasien Belum Diperiksa')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Daftar Pasien Belum Diperiksa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Memeriksa Pasien</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content py-6 bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md transition duration-300">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <div>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
                <button type="button" class="ml-auto text-green-700 hover:text-green-900" data-dismiss="alert" aria-label="Close">
                    <span class="text-2xl">×</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="flex items-center bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md transition duration-300">
                <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
                <div>
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
                <button type="button" class="ml-auto text-red-700 hover:text-red-900" data-dismiss="alert" aria-label="Close">
                    <span class="text-2xl">×</span>
                </button>
            </div>
        @endif

        <!-- Data Table Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <h3 class="text-xl font-bold">
                    <i class="fas fa-stethoscope mr-2"></i> Pasien Menunggu Pemeriksaan
                </h3>
            </div>
            <div class="p-6">
                @if($periksas->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="periksaTable">
                            <thead class="bg-gray-200 text-gray-700">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">No</th>
                                    <th class="p-4 text-sm font-semibold">Nama Pasien</th>
                                    <th class="p-4 text-sm font-semibold">Jadwal Periksa</th>
                                    <th class="p-4 text-sm font-semibold">Keluhan</th>
                                    <th class="p-4 text-sm font-semibold">Status & Antrian</th>
                                    <th class="p-4 text-sm font-semibold">Dokter</th>
                                    <th class="p-4 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periksas as $index => $janjiPeriksa)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm">{{ $index + 1 }}</td>
                                        <td class="p-4 text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-user-injured text-blue-500 mr-2"></i>
                                                <span class="font-medium">{{ $janjiPeriksa->pasien->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt text-teal-500 mr-2"></i>
                                                <div>
                                                    <span class="font-medium">{{ ucfirst($janjiPeriksa->jadwalPeriksa->hari) }}</span>
                                                    <br>
                                                    <span class="text-xs text-gray-500">
                                                        {{ $janjiPeriksa->jadwalPeriksa->jam_mulai }} - {{ $janjiPeriksa->jadwalPeriksa->jam_selesai }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm">
                                            @if($janjiPeriksa->keluhan)
                                                <span class="text-gray-600">{{ Str::limit($janjiPeriksa->keluhan, 50) }}</span>
                                            @else
                                                <span class="text-gray-400 italic">Belum ada keluhan</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Menunggu Pemeriksaan
                                            </span>
                                            <br>
                                            <span class="text-xs text-gray-500">No. Antrian: {{ $janjiPeriksa->no_antrian }}</span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex items-center">
                                                <i class="fas fa-user-md text-green-500 mr-2"></i>
                                                <span>{{ $janjiPeriksa->jadwalPeriksa->dokter->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('dokter.periksa_edit', $janjiPeriksa->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200"
                                                   title="Periksa Pasien">
                                                    <i class="fas fa-stethoscope mr-1"></i> Periksa
                                                </a>
                                                <button type="button"
                                                        class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200"
                                                        data-toggle="modal"
                                                        data-target="#deleteModal{{ $janjiPeriksa->id }}"
                                                        title="Tolak Pemeriksaan">
                                                    <i class="fas fa-times mr-1"></i> Tolak
                                                </button>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal{{ $janjiPeriksa->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content rounded-xl shadow-lg">
                                                        <div class="modal-header bg-red-600 text-white p-4">
                                                            <h5 class="modal-title font-semibold">
                                                                <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Penolakan
                                                            </h5>
                                                            <button type="button" class="text-white hover:text-gray-200" data-dismiss="modal">
                                                                <span class="text-2xl">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body p-6">
                                                            <p class="text-gray-700">Apakah Anda yakin ingin menolak pemeriksaan untuk pasien <strong>{{ $janjiPeriksa->pasien->name ?? 'N/A' }}</strong>?</p>
                                                            <p class="text-gray-500 text-sm">Tindakan ini tidak dapat dibatalkan.</p>
                                                        </div>
                                                        <div class="modal-footer p-4 bg-gray-50">
                                                            <button type="button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200" data-dismiss="modal">
                                                                <i class="fas fa-times mr-1"></i> Batal
                                                            </button>
                                                            <form action="{{ route('dokter.tolakPeriksa', $janjiPeriksa->id) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                                                                    <i class="fas fa-trash mr-1"></i> Ya, Tolak
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mb-4">
                            <i class="fas fa-clipboard-check text-6xl text-gray-300"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-600">Tidak Ada Pasien Menunggu</h4>
                        <p class="text-gray-500">Saat ini tidak ada pasien yang menunggu untuk diperiksa.</p>
                        <a href="{{ route('dokter.dashboard') }}"
                           class="inline-flex items-center px-4 py-2 mt-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Include Tailwind CSS and Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#periksaTable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[2, "desc"]], // Sort by date descending
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });

            // Auto hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection