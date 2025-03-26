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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data</td>
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
