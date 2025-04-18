@extends('components.layoutpasien')

@section('content')
<!-- Main content -->
<section class="content">
  <h1>Periksa</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Pemeriksaan</h3>
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

            <form action="{{ url('/pasien/periksa') }}" method="POST">
              @csrf

              <div class="form-group">
                <label for="id_dokter">Dokter <span class="text-danger">*</span></label>
                <select id="dokter" name="id_dokter" class="form-control custom-select @error('id_dokter') is-invalid @enderror" required>
                  <option selected disabled>Pilih Dokter</option>
                  @foreach($dokters as $dokter)
                    <option value="{{ $dokter['id'] }}">{{ $dokter['nama'] }}</option>
                  @endforeach
                </select>
                @error('id_dokter')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tgl_periksa">Tanggal Periksa <span class="text-danger">*</span></label>
                <input type="date" name="tgl_periksa" id="tgl_periksa" class="form-control @error('tgl_periksa') is-invalid @enderror" value="{{ old('tgl_periksa') }}" required>
                @error('tgl_periksa')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Opsional">{{ old('catatan') }}</textarea>
                @error('catatan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <small class="form-text text-muted mb-3"><span class="text-danger">*</span> Wajib diisi</small>

              <button type="submit" class="btn btn-primary">Buat Periksa</button>
            </form>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
@endsection
