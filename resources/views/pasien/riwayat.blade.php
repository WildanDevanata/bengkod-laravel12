@extends('components.layoutpasien')

@section('content') 
<h1>Riwayat</h1>
    <div class="row">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Pemeriksaan</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Pasien</th>
                                <th>Tanggal Periksa</th>
                                <th>Nama Dokter</th>
                                <th>Catatan Dokter</th>
                                <th>Biaya Periksa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($periksas as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->pasien->nama ?? 'Tidak ada data' }}</td>
                                    <td>{{ $p->tgl_periksa }}</td>
                                    <td>{{ $p->dokter->nama ?? 'Tidak diketahui' }}</td>
                                    <td>{{ $p->catatan }}</td>
                                    <td>{{ number_format($p->biaya_periksa, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('pasien.editPeriksa', $p->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('pasien.deletePeriksa', $p->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
