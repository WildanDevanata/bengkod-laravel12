@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <span class="right badge bg-primary">Pasien</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pasien.janjiPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Janji Periksa
                    <span class="right badge bg-primary">Pasien</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pasien.riwayat') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Riwayat Periksa
                    <span class="right badge bg-primary">Pasien</span>
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
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-fade-in border border-gray-200">
                <div class="p-6 bg-gradient-to-r from-green-600 to-green-700 text-white flex justify-between items-center border-b border-green-800">
                    <h3 class="text-lg font-bold">
                        <i class="fas fa-history mr-2"></i> Riwayat Pemeriksaan Saya
                    </h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 shadow-sm">
                        {{ count($periksas) }} Pemeriksaan
                    </span>
                </div>
                <div class="p-6 sm:p-8">
                    @if(count($periksas) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse border border-gray-300" id="riwayatTable">
                                <thead class="thead-light bg-gray-50 text-gray-800 border-b-2 border-gray-300">
                                    <tr>
                                        <th class="p-4 text-sm font-semibold w-12 border-r border-gray-300">No</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Tanggal Periksa</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Dokter</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Keluhan</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Catatan</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Obat</th>
                                        <th class="p-4 text-sm font-semibold border-r border-gray-300">Biaya</th>
                                        <th class="p-4 text-sm font-semibold">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periksas as $index => $periksa)
                                        <tr class="border-b hover:bg-gray-50 transition duration-200">
                                            <td class="p-4 text-sm font-medium border-r border-gray-300">{{ $index + 1 }}</td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                                    {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}
                                                </span>
                                                <br>
                                                <small class="text-gray-600">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('H:i') }}</small>
                                            </td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                <strong>{{ $periksa->janjiPeriksa->jadwalPeriksa->dokter->name ?? 'Dokter tidak ditemukan' }}</strong>
                                                @if(isset($periksa->janjiPeriksa->jadwalPeriksa->dokter->poli))
                                                    <br>
                                                    <small class="text-gray-600">{{ $periksa->janjiPeriksa->jadwalPeriksa->dokter->poli->nama_poli }}</small>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                @if($periksa->janjiPeriksa && $periksa->janjiPeriksa->keluhan)
                                                    <p class="mb-0">{{ Str::limit($periksa->janjiPeriksa->keluhan, 100) }}</p>
                                                    @if(strlen($periksa->janjiPeriksa->keluhan) > 100)
                                                        <small>
                                                            <a href="#" class="text-blue-600 hover:underline" data-toggle="modal" data-target="#keluhanModal{{ $periksa->id }}">Lihat selengkapnya...</a>
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                @if($periksa->catatan)
                                                    <p class="mb-0">{{ Str::limit($periksa->catatan, 100) }}</p>
                                                    @if(strlen($periksa->catatan) > 100)
                                                        <small>
                                                            <a href="#" class="text-blue-600 hover:underline" data-toggle="modal" data-target="#catatanModal{{ $periksa->id }}">Lihat selengkapnya...</a>
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-gray-600">-</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                @if($periksa->obat && count($periksa->obat) > 0)
                                                    <div class="flex flex-col space-y-1">
                                                        @foreach($periksa->obat as $obat)
                                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                                                {{ $obat->nama_obat }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-gray-600">Tidak ada obat</span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm border-r border-gray-300">
                                                <strong class="text-green-600">Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</strong>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <button class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 hover:scale-105 transition transform duration-200" data-toggle="modal" data-target="#detailModal{{ $periksa->id }}">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modals untuk Detail -->
                        @foreach($periksas as $periksa)
                            <!-- Modal Detail Lengkap -->
                            <div class="modal fade" id="detailModal{{ $periksa->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content rounded-2xl shadow-xl transform transition-all duration-300 border border-gray-200">
                                        <div class="modal-header bg-blue-600 text-white p-5 border-b border-blue-700">
                                            <h5 class="modal-title font-semibold text-lg">
                                                <i class="fas fa-file-medical mr-2"></i> Detail Pemeriksaan - {{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y') }}
                                            </h5>
                                            <button type="button" class="text-white hover:text-gray-200 transition duration-200" data-dismiss="modal" aria-label="Close">
                                                <span class="text-2xl font-bold">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <h6 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-4">Informasi Pemeriksaan</h6>
                                                    <table class="w-full text-sm">
                                                        <tr>
                                                            <td class="py-2 font-medium">Tanggal:</td>
                                                            <td class="py-2">{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('d M Y H:i') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 font-medium">Dokter:</td>
                                                            <td class="py-2">{{ $periksa->janjiPeriksa->jadwalPeriksa->dokter->name ?? 'Dokter tidak ditemukan' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 font-medium">Biaya:</td>
                                                            <td class="py-2"><strong class="text-green-600">Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</strong></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div>
                                                    <h6 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-4">Obat yang Diberikan</h6>
                                                    @if($periksa->obat && count($periksa->obat) > 0)
                                                        <ul class="space-y-2">
                                                            @foreach($periksa->obat as $obat)
                                                                <li class="p-2 bg-gray-50 rounded-md shadow-sm border border-gray-200">
                                                                    <strong>{{ $obat->nama_obat }}</strong>
                                                                    <br>
                                                                    <small class="text-gray-600">{{ $obat->kemasan }}</small>
                                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 float-right">
                                                                        Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-gray-600">Tidak ada obat yang diberikan</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="my-6 border-gray-300">
                                            <div>
                                                <h6 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-4">Keluhan</h6>
                                                <div class="p-4 bg-gray-50 rounded-md shadow-sm border border-gray-200">
                                                    @if($periksa->janjiPeriksa && $periksa->janjiPeriksa->keluhan)
                                                        {{ $periksa->janjiPeriksa->keluhan }}
                                                    @else
                                                        <span class="text-gray-600">Tidak ada keluhan tercatat</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if($periksa->catatan)
                                                <div class="mt-6">
                                                    <h6 class="text-lg font-semibold text-gray-800 border-b border-gray-300 pb-2 mb-4">Catatan Dokter</h6>
                                                    <div class="p-4 bg-blue-50 rounded-md shadow-sm border border-blue-200">
                                                        {{ $periksa->catatan }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer p-5 bg-gray-50 flex justify-end border-t border-gray-200">
                                            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200" data-dismiss="modal">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Keluhan -->
                            @if($periksa->janjiPeriksa && $periksa->janjiPeriksa->keluhan && strlen($periksa->janjiPeriksa->keluhan) > 100)
                                <div class="modal fade" id="keluhanModal{{ $periksa->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content rounded-2xl shadow-xl transform transition-all duration-300 border border-gray-200">
                                            <div class="modal-header bg-blue-600 text-white p-5 border-b border-blue-700">
                                                <h5 class="modal-title font-semibold text-lg">Keluhan Lengkap</h5>
                                                <button type="button" class="text-white hover:text-gray-200 transition duration-200" data-dismiss="modal" aria-label="Close">
                                                <span class="text-2xl font-bold">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-6">
                                            {{ $periksa->janjiPeriksa->keluhan }}
                                        </div>
                                        <div class="modal-footer p-5 bg-gray-50 flex justify-end border-t border-gray-200">
                                            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200" data-dismiss="modal">
                                                Tutup
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Modal Catatan -->
                            @if($periksa->catatan && strlen($periksa->catatan) > 100)
                                <div class="modal fade" id="catatanModal{{ $periksa->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content rounded-2xl shadow-xl transform transition-all duration-300 border border-gray-200">
                                            <div class="modal-header bg-blue-600 text-white p-5 border-b border-blue-700">
                                                <h5 class="modal-title font-semibold text-lg">Catatan Dokter Lengkap</h5>
                                                <button type="button" class="text-white hover:text-gray-200 transition duration-200" data-dismiss="modal" aria-label="Close">
                                                    <span class="text-2xl font-bold">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-6">
                                                {{ $periksa->catatan }}
                                            </div>
                                            <div class="modal-footer p-5 bg-gray-50 flex justify-end border-t border-gray-200">
                                                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200" data-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 animate-fade-in border border-gray-200 rounded-lg shadow-sm bg-white">
                            <i class="fas fa-clipboard-list text-6xl text-gray-300 mb-4 animate-pulse"></i>
                            <h4 class="text-2xl font-semibold text-gray-700">Belum Ada Riwayat Pemeriksaan</h4>
                            <p class="text-gray-500 mt-2">Silakan buat janji periksa terlebih dahulu.</p>
                            <a href="{{ route('pasien.janjiPeriksa') }}" class="inline-flex items-center px-4 py-2 mt-4 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 hover:scale-105 transition transform duration-200">
                                <i class="fas fa-calendar-plus mr-2"></i> Buat Janji Periksa
                            </a>
                        </div>
                    @endif
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


@section('js')
<script src="{{ asset('vendor/lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function () {
        $("#riwayatTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": [[1, "desc"]], // Sort by date descending
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "pageLength": 10,
            "columnDefs": [
                { "orderable": false, "targets": [7] } // Disable sorting for Detail column
            ]
        });
    });
</script>
@stop