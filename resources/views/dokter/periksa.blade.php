@extends('components.layoutdokter')

@section('content') 
<h1>Periksa</h1>
<div class="row">
    <div class="col-12">
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
                            <th>Catatan Dokter</th>
                            <th>Biaya Periksa</th>
                            <th>Obat</th>
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
                                <td>{{ $p->catatan }}</td>
                                <td>{{ number_format($p->biaya_periksa, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->detailPeriksas->isNotEmpty() && $p->detailPeriksas->first()->obat)
                                        {{ $p->detailPeriksas->first()->obat->nama_obat }}
                                    @else
                                        Belum ada
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('dokter.periksa.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('dokter.periksa.delete', $p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Delete</button>
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
@endsection