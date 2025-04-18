@extends('components.layoutpasien')

@section('content')
<!-- Main content -->
<section class="content">
  <h1>Edit Periksa</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Data Pemeriksaan</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            @if(session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

            <form action="{{ route('pasien.updatePeriksa', $periksa->id) }}" method="POST">
              @csrf
              @method('PUT')

              <!-- Nama Pasien -->
              <div class="form-group">
                <label for="inputName">Nama Anda</label>
                <input type="text" id="inputName" name="nama" class="form-control" value="{{ $periksa->pasien->nama ?? '' }}" placeholder="Masukkan nama Anda" required>
              </div>

              <!-- Nomor HP Pasien -->
            

              <!-- Pilih Dokter -->
              <div class="form-group">
                <label for="dokter">Pilih Dokter</label>
                <select id="dokter" name="id_dokter" class="form-control custom-select" required>
                  <option disabled>Pilih Dokter</option>
                  @foreach($dokters as $dokter)
                    <option value="{{ $dokter['id'] }}" {{ $periksa->id_dokter == $dokter['id'] ? 'selected' : '' }}>
                      {{ $dokter['nama'] }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Tanggal Pemeriksaan -->
              <div class="form-group">
                <label for="tgl_periksa">Tanggal Pemeriksaan</label>
                <input type="date" id="tgl_periksa" name="tgl_periksa" class="form-control" value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d') }}" required>
              </div>

              <!-- Catatan Dokter -->
              <div class="form-group">
                <label for="catatan">Catatan Dokter</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="4" placeholder="Deskripsikan keluhan Anda">{{ $periksa->catatan }}</textarea>
              </div>

              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a href="{{ route('pasien.riwayat') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
</section>
@endsection
