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
    <section class="content py-8 bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Content Header -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 animate-fade-in">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800">Data Poli</h1>
                <nav class="mt-4 sm:mt-0">
                    <ol class="flex space-x-2 text-sm text-gray-600">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Home</a></li>
                        <li class="flex items-center">
                            <span class="mx-2">/</span>
                            <span class="font-semibold">Data Poli</span>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="flex items-center bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
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
                <div class="flex items-center bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
                    <i class="fas fa-exclamation-triangle mr-3 text-2xl"></i>
                    <div>
                        <p class="font-semibold text-base"><strong>Gagal!</strong> {{ session('error') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-gray-600 hover:text-gray-800 transition-colors duration-200" data-dismiss="alert" aria-label="Close">
                        <span class="text-2xl font-bold">×</span>
                    </button>
                </div>
            @endif

            <!-- Add New Poli Card -->
            <div class="bg-white rounded-2xl shadow-xl mb-8 overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Poli Baru
                    </h3>
                </div>
                <form method="POST" action="{{ route('admin.createPolis') }}">
                    @csrf
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_poli" class="block text-sm font-semibold text-gray-700">Nama Poli <span class="text-red-500">*</span></label>
                                <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('nama_poli') border-red-500 @enderror"
                                       id="nama_poli" name="nama_poli" value="{{ old('nama_poli') }}" placeholder="Masukkan nama poli" required>
                                @error('nama_poli')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="keterangan" class="block text-sm font-semibold text-gray-700">Keterangan</label>
                                <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('keterangan') border-red-500 @enderror"
                                          id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan (opsional)">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="p-6 bg-gray-50 border-t flex justify-end space-x-3">
                        <button type="reset" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                            <i class="fas fa-undo mr-2"></i> Reset
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition transform duration-200">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Table Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-table mr-2"></i> Daftar Poli
                    </h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table id="poliTable" class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 text-gray-800">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">No</th>
                                    <th class="p-4 text-sm font-semibold">Nama Poli</th>
                                    <th class="p-4 text-sm font-semibold">Keterangan</th>
                                    <th class="p-4 text-sm font-semibold">Tanggal Dibuat</th>
                                    <th class="p-4 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($poli as $index => $item)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm font-medium">{{ $index + 1 }}</td>
                                        <td class="p-4 text-sm font-semibold">{{ $item->nama_poli }}</td>
                                        <td class="p-4 text-sm">{{ $item->keterangan ?? '-' }}</td>
                                        <td class="p-4 text-sm">
                                            <span class="text-gray-600 text-xs">
                                                {{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.editPoli', $item->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 hover:scale-105 transition transform duration-200"
                                                   title="Edit Poli">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.deletePoli', $item->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-700 hover:scale-105 transition transform duration-200"
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus poli {{ $item->nama_poli }}?')"
                                                   title="Hapus Poli">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-12">
                                            <div class="animate-fade-in">
                                                <i class="fas fa-inbox text-6xl text-gray-300 mb-4 animate-pulse"></i>
                                                <p class="text-gray-500 text-lg">Belum ada data poli</p>
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
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#poliTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": true,
                "info": true,
                "paging": true,
                "searching": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#poliTable_wrapper .col-md-6:eq(0)');

            // Auto hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection