@extends('components.layoutpasien')

@section('content')
<!-- Main content -->
<section class="content">
  <h1>Periksa</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Periksa</h3>

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
            
            <form action="{{ route('pasien.storePeriksa') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="inputName">Nama Anda</label>
                <input type="text" id="inputName" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
              </div>
              <div class="form-group">
                <label for="inputPhone">Nomor HP</label>
                <input type="text" id="inputPhone" name="no_hp" class="form-control" placeholder="Masukkan nomor HP Anda" required>
              </div>
              <div class="form-group">
                <label for="dokter">Pilih Dokter</label>
                <select id="dokter" name="id_dokter" class="form-control custom-select" required>
                  <option selected disabled>Pilih Dokter</option>
                  @foreach($dokters as $dokter)
                    <option value="{{ $dokter['id'] }}">{{ $dokter['nama'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="catatan">Keluhan</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="4" placeholder="Deskripsikan keluhan Anda"></textarea>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-success">Submit</button>
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