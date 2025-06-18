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
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in">
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white flex justify-between items-center">
                    <h3 class="text-2xl font-bold tracking-tight">
                        <i class="fas fa-user-md mr-2"></i> Daftar Dokter
                    </h3>
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 hover:scale-105 transition transform duration-200" data-toggle="modal" data-target="#addDokterModal">
                        <i class="fas fa-plus mr-2"></i> Tambah Dokter
                    </button>
                </div>
                <div class="p-6 sm:p-8">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="flex items-center bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
                            <i class="fas fa-check-circle mr-3 text-2xl"></i>
                            <p class="font-semibold text-base">{{ session('success') }}</p>
                            <button type="button" class="ml-auto text-gray-600 hover:text-gray-800 transition-colors duration-200" data-dismiss="alert" aria-label="Close">
                                <span class="text-2xl font-bold">×</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="flex items-center bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 transform animate-fade-in">
                            <i class="fas fa-exclamation-triangle mr-3 text-2xl"></i>
                            <p class="font-semibold text-base">{{ session('error') }}</p>
                            <button type="button" class="ml-auto text-gray-600 hover:text-gray-800 transition-colors duration-200" data-dismiss="alert" aria-label="Close">
                                <span class="text-2xl font-bold">×</span>
                            </button>
                        </div>
                    @endif

                    <!-- Tabel Dokter -->
                    <div class="overflow-x-auto">
                        <table id="dokterTable" class="w-full text-left border-collapse">
                            <thead class="bg-gray-100 text-gray-800">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">#</th>
                                    <th class="p-4 text-sm font-semibold">No KTP</th>
                                    <th class="p-4 text-sm font-semibold">Nama</th>
                                    <th class="p-4 text-sm font-semibold">Email</th>
                                    <th class="p-4 text-sm font-semibold">No HP</th>
                                    <th class="p-4 text-sm font-semibold">Alamat</th>
                                    <th class="p-4 text-sm font-semibold">Poli</th>
                                    <th class="p-4 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $dokter)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm font-medium">{{ $index + 1 }}</td>
                                        <td class="p-4 text-sm">{{ $dokter->no_ktp }}</td>
                                        <td class="p-4 text-sm font-semibold">{{ $dokter->name }}</td>
                                        <td class="p-4 text-sm">{{ $dokter->email }}</td>
                                        <td class="p-4 text-sm">{{ $dokter->no_hp ?? '-' }}</td>
                                        <td class="p-4 text-sm">{{ $dokter->alamat ?? '-' }}</td>
                                        <td class="p-4 text-sm">
                                            @if($dokter->poli)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                                    {{ $dokter->poli->nama_poli }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 shadow-sm">
                                                    Belum Ditentukan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ url('/admin/dokter/edit/' . $dokter->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md shadow-sm hover:bg-yellow-600 hover:scale-105 transition transform duration-200"
                                                   title="Edit Dokter">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('/admin/dokter/delete/' . $dokter->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-700 hover:scale-105 transition transform duration-200"
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus dokter {{ $dokter->name }}?')"
                                                   title="Hapus Dokter">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-12">
                                            <div class="animate-fade-in">
                                                <i class="fas fa-user-md text-6xl text-gray-300 mb-4 animate-pulse"></i>
                                                <p class="text-gray-500 text-lg">Belum ada data dokter</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Add Dokter -->
            <div class="modal fade" id="addDokterModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content rounded-2xl shadow-xl transform transition-all duration-300">
                        <div class="modal-header bg-blue-600 text-white p-5">
                            <h4 class="modal-title font-semibold text-lg">
                                <i class="fas fa-user-plus mr-2"></i> Tambah Dokter Baru
                            </h4>
                            <button type="button" class="text-white hover:text-gray-200 transition duration-200" data-dismiss="modal" aria-label="Close">
                                <span class="text-2xl font-bold">×</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.dokter') }}" method="POST">
                            @csrf
                            <div class="modal-body p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="no_ktp" class="block text-sm font-semibold text-gray-700">NIK <span class="text-red-500">*</span></label>
                                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('no_ktp') border-red-500 @enderror"
                                               id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}" placeholder="Masukkan NIK dokter" required>
                                        @error('no_ktp')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="name" class="block text-sm font-semibold text-gray-700">Nama Dokter <span class="text-red-500">*</span></label>
                                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('name') border-red-500 @enderror"
                                               id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap dokter" required>
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-semibold text-gray-700">Email <span class="text-red-500">*</span></label>
                                        <input type="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('email') border-red-500 @enderror"
                                               id="email" name="email" value="{{ old('email') }}" placeholder="dokter@example.com" required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700">Password <span class="text-red-500">*</span></label>
                                        <input type="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('password') border-red-500 @enderror"
                                               id="password" name="password" placeholder="Minimal 8 karakter" required>
                                        @error('password')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                                        <input type="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                               id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
                                    </div>
                                    <div>
                                        <label for="no_hp" class="block text-sm font-semibold text-gray-700">No. HP</label>
                                        <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('no_hp') border-red-500 @enderror"
                                               id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                                        @error('no_hp')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="poli_id" class="block text-sm font-semibold text-gray-700">Poli <span class="text-red-500">*</span></label>
                                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('poli_id') border-red-500 @enderror"
                                                id="poli_id" name="poli_id" required>
                                            <option value="">-- Pilih Poli --</option>
                                            @foreach($polis ?? [] as $poli)
                                                <option value="{{ $poli->id }}" {{ old('poli_id') == $poli->id ? 'selected' : '' }}>{{ $poli->nama_poli }}</option>
                                            @endforeach
                                        </select>
                                        @error('poli_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="alamat" class="block text-sm font-semibold text-gray-700">Alamat</label>
                                        <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('alamat') border-red-500 @enderror"
                                                  id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="dokter">
                            </div>
                            <div class="modal-footer p-5 bg-gray-50 flex justify-end space-x-3">
                                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200" data-dismiss="modal">
                                    <i class="fas fa-times mr-2"></i> Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition transform duration-200">
                                    <i class="fas fa-save mr-2"></i> Simpan Dokter
                                </button>
                            </div>
                        </form>
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
            $("#dokterTable").DataTable({
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
            }).buttons().container().appendTo('#dokterTable_wrapper .col-md-6:eq(0)');

            // Show modal if there are validation errors
            @if($errors->any())
                $('#addDokterModal').modal('show');
            @endif

            // Auto hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Password confirmation validation
            $('#password_confirmation').on('keyup', function () {
                var password = $('#password').val();
                var confirmPassword = $(this).val();

                if (password !== confirmPassword) {
                    $(this).addClass('is-invalid');
                    if ($(this).next('.invalid-feedback').length === 0) {
                        $(this).after('<div class="invalid-feedback">Password tidak cocok</div>');
                    }
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });
        });
    </script>
@endsection