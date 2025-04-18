@extends('components.layoutdokter')

@section('content')
    <h1>Edit Periksa</h1>
    <form action="{{ route('dokter.periksa.update', $periksa->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="catatan">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" required>{{ $periksa->catatan }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="biaya_periksa">Biaya Periksa</label>
            <input type="number" class="form-control" id="biaya_periksa" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}" required>
        </div>
        
        <div class="form-group">
            <label for="id_obat">Obat</label>
            <select class="form-control" id="id_obat" name="id_obat">
                <option value="">Pilih Obat (Opsional)</option>
                @foreach ($obats as $obat)
                    @php
                        $selectedObatId = null;
                        if ($periksa->detailPeriksas->isNotEmpty() && $periksa->detailPeriksas->first()->id_obat) {
                            $selectedObatId = $periksa->detailPeriksas->first()->id_obat;
                        }
                    @endphp
                    <option value="{{ $obat->id }}" {{ $obat->id == $selectedObatId ? 'selected' : '' }}>
                        {{ $obat->nama_obat }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection