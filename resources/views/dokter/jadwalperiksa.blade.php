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
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jadwal Periksa</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jadwal Periksa</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content py-6 bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="flex items-center bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md transition duration-300">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <div>
                    <h5 class="font-semibold">Berhasil!</h5>
                    <p>{{ session('success') }}</p>
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
                    <h5 class="font-semibold">Error!</h5>
                    <p>{{ session('error') }}</p>
                </div>
                <button type="button" class="ml-auto text-red-700 hover:text-red-900" data-dismiss="alert" aria-label="Close">
                    <span class="text-2xl">×</span>
                </button>
            </div>
        @endif

        <!-- Info Jadwal Aktif -->
        @if(isset($activeSchedule))
            <div class="flex items-center bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg shadow-md transition duration-300">
                <i class="fas fa-info-circle mr-3 text-xl"></i>
                <div>
                    <h5 class="font-semibold">Jadwal Aktif Saat Ini</h5>
                    <p>
                        <strong>{{ ucfirst($activeSchedule->hari) }}</strong> -
                        {{ date('H:i', strtotime($activeSchedule->jam_mulai)) }} sampai
                        {{ date('H:i', strtotime($activeSchedule->jam_selesai)) }}
                    </p>
                    <p class="text-sm text-blue-600">Hanya satu jadwal yang dapat aktif pada satu waktu.</p>
                </div>
                <button type="button" class="ml-auto text-blue-700 hover:text-blue-900" data-dismiss="alert" aria-label="Close">
                    <span class="text-2xl">×</span>
                </button>
            </div>
        @else
            <div class="flex items-center bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-lg shadow-md transition duration-300">
                <i class="fas fa-exclamation-triangle mr-3 text-xl"></i>
                <div>
                    <h5 class="font-semibold">Peringatan</h5>
                    <p>Saat ini tidak ada jadwal yang aktif. Pasien tidak dapat mendaftar tanpa jadwal aktif.</p>
                </div>
                <button type="button" class="ml-auto text-yellow-700 hover:text-yellow-900" data-dismiss="alert" aria-label="Close">
                    <span class="text-2xl">×</span>
                </button>
            </div>
        @endif

        <!-- Form Tambah Jadwal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <h3 class="text-xl font-bold">
                    <i class="fas fa-calendar-plus mr-2"></i> Tambah Jadwal Periksa
                </h3>
            </div>
            <form action="{{ route('dokter.storeJadwal') }}" method="POST">
                @csrf
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari <span class="text-red-500">*</span></label>
                            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('hari') border-red-500 @enderror" id="hari" name="hari" required>
                                <option value="">Pilih Hari</option>
                                @foreach($hariOptions as $key => $value)
                                    <option value="{{ $key }}" {{ old('hari') == $key ? 'selected' : '' }}>{{ ucfirst($value) }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status <span class="text-red-500">*</span></label>
                            <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai <span class="text-red-500">*</span></label>
                            <input type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_mulai') border-red-500 @enderror" id="jam_mulai" name="jam_mulai" value="{{ old('jam_mulai') }}" required>
                            @error('jam_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai <span class="text-red-500">*</span></label>
                            <input type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('jam_selesai') border-red-500 @enderror" id="jam_selesai" name="jam_selesai" value="{{ old('jam_selesai') }}" required>
                            @error('jam_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @if($errors->has('jadwal'))
                        <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                            <p>{{ $errors->first('jadwal') }}</p>
                        </div>
                    @endif
                </div>
                <div class="p-6 bg-gray-50 flex justify-end space-x-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                        <i class="fas fa-save mr-2"></i> Simpan Jadwal
                    </button>
                    <button type="reset" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                        <i class="fas fa-undo mr-2"></i> Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Jadwal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <h3 class="text-xl font-bold">
                    <i class="fas fa-calendar-alt mr-2"></i> Daftar Jadwal Periksa
                </h3>
            </div>
            <div class="p-6">
                @if($jadwalPeriksa->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-200 text-gray-700">
                                <tr>
                                    <th class="p-4 text-sm font-semibold w-12">#</th>
                                    <th class="p-4 text-sm font-semibold">Hari</th>
                                    <th class="p-4 text-sm font-semibold">Jam Mulai</th>
                                    <th class="p-4 text-sm font-semibold">Jam Selesai</th>
                                    <th class="p-4 text-sm font-semibold">Status</th>
                                    <th class="p-4 text-sm font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwalPeriksa as $index => $jadwal)
                                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                                        <td class="p-4 text-sm">{{ $index + 1 }}</td>
                                        <td class="p-4 text-sm">{{ ucfirst($jadwal->hari) }}</td>
                                        <td class="p-4 text-sm">{{ date('H:i', strtotime($jadwal->jam_mulai)) }}</td>
                                        <td class="p-4 text-sm">{{ date('H:i', strtotime($jadwal->jam_selesai)) }}</td>
                                        <td class="p-4 text-sm">
                                            @if($jadwal->status == 1)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <i class="fas fa-check mr-1"></i> Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <i class="fas fa-times mr-1"></i> Tidak Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm">
                                            <div class="flex space-x-2">
                                                <!-- Toggle Status Button -->
                                                <form action="{{ route('dokter.toggleStatusJadwal', $jadwal->id) }}" method="POST"
                                                      onsubmit="return confirm('{{ $jadwal->status == 1 ? 'Apakah Anda yakin ingin menonaktifkan jadwal ini?' : 'Apakah Anda yakin ingin mengaktifkan jadwal ini? Jadwal aktif lainnya akan dinonaktifkan.' }}')">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($jadwal->status == 1)
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-200" title="Nonaktifkan Jadwal">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-200" title="Aktifkan Jadwal">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                <a href="{{ route('dokter.editJadwal', $jadwal->id) }}"
                                                   class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200" title="Edit Jadwal">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('dokter.deleteJadwal', $jadwal->id) }}" method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200" title="Hapus Jadwal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
                            <i class="fas fa-info-circle text-6xl text-gray-300"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-gray-600">Informasi</h4>
                        <p class="text-gray-500">Belum ada jadwal periksa yang ditambahkan.</p>
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
            // Auto-hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endsection