@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.obat') }}" class="nav-link">
                <i class="nav-icon fas fa-pills"></i>
                <p>
                    Obat
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.dokter') }}" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                    Dokter
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pasien') }}" class="nav-link">
                <i class="nav-icon fas fa-procedures"></i>
                <p>
                    Pasien
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.poliMaster') }}" class="nav-link">
                <i class="nav-icon fas fa-hospital"></i>
                <p>
                    Poli
                    <span class="right badge bg-success">Admin</span>
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
    <section class="content py-12 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Daftar Obat</h1>
                <p class="text-lg text-gray-600 mt-2">Kelola obat-obat yang tersedia di klinik Anda dengan mudah dan efisien.</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div id="alert-success" class="flex items-center bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
                    <i class="fas fa-check-circle mr-3 text-2xl"></i>
                    <div>
                        <p class="font-semibold text-base"><strong>Berhasil!</strong> {{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-gray-600 hover:text-gray-800 transition-colors duration-200" data-dismiss="alert" aria-label="Close">
                        <span class="text-2xl font-bold">×</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div id="alert-error" class="flex items-center bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
                    <i class="fas fa-exclamation-triangle mr-3 text-2xl"></i>
                    <div>
                        <p class="font-semibold text-base"><strong>Gagal!</strong> {{ session('error') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-gray-600 hover:text-gray-800 transition-colors duration-200" data-dismiss="alert" aria-label="Close">
                        <span class="text-2xl font-bold">×</span>
                    </button>
                </div>
            @endif

            <!-- Form Tambah Obat -->
            <div class="bg-white rounded-2xl shadow-xl mb-8 overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Obat
                    </h3>
                </div>
                <div class="p-6">
                    <form action="{{ url('admin/obat') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="nama_obat" class="block text-sm font-semibold text-gray-700">Nama Obat</label>
                                <input type="text" name="nama_obat" id="nama_obat" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                            <div>
                                <label for="kemasan" class="block text-sm font-semibold text-gray-700">Kemasan</label>
                                <input type="text" name="kemasan" id="kemasan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                            <div>
                                <label for="harga" class="block text-sm font-semibold text-gray-700">Harga</label>
                                <input type="number" name="harga" id="harga" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition transform duration-200">
                                <i class="fas fa-save mr-2"></i> Tambah Obat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Obat -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-table mr-2"></i> Daftar Obat yang Tersedia
                    </h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 text-gray-800">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">No</th>
                                    <th class="p-4 text-sm font-semibold">Nama Obat</th>
                                    <th class="p-4 text-sm font-semibold">Kemasan</th>
                                    <th class="p-4 text-sm font-semibold">Harga</th>
                                    <th class="p-4 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($obat as $key => $item)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm font-medium">{{ $key + 1 }}</td>
                                        <td class="p-4 text-sm">{{ $item->nama_obat }}</td>
                                        <td class="p-4 text-sm">{{ $item->kemasan }}</td>
                                        <td class="p-4 text-sm">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                                Rp {{ number_format((float) $item->harga, 2, ',', '.') }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ url('admin/obat/edit/' . $item->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 hover:scale-105 transition transform duration-200"
                                                   title="Edit Obat">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('admin/obat/delete/' . $item->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-700 hover:scale-105 transition transform duration-200"
                                                   onclick="return confirm('Yakin ingin menghapus obat ini?')"
                                                   title="Hapus Obat">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-12">
                                            <div class="animate-fade-in">
                                                <i class="fas fa-prescription-bottle-alt text-6xl text-gray-300 mb-4 animate-pulse"></i>
                                                <p class="text-gray-500 text-lg">Tidak ada data obat</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

    <!-- Script to hide alerts after 2 seconds -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                const successAlert = document.getElementById("alert-success");
                const errorAlert = document.getElementById("alert-error");

                if (successAlert) {
                    successAlert.classList.add("fade");
                    successAlert.classList.remove("show");
                    setTimeout(() => successAlert.remove(), 150); // Remove from DOM after fade
                }
                if (errorAlert) {
                    errorAlert.classList.add("fade");
                    errorAlert.classList.remove("show");
                    setTimeout(() => errorAlert.remove(), 150); // Remove from DOM after fade
                }
            }, 2000);
        });
    </script>
@endsection