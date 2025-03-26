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
            <div class="form-group">
                <label for="inputName">Nama Anda</label>
                <input type="text" id="inputName" class="form-control" placeholder="Masukkan nama Anda">
            </div>            
            <div class="form-group">
              <label for="inputStatus">Pilih Dokter</label>
              <select id="inputStatus" class="form-control custom-select">
                <option selected disabled>Select one</option>
                <option>On Hold</option>
                <option>Canceled</option>
                <option>Success</option>
              </select>
        </div>
        <div class="row">
          <div class="col-12 padding px-2">
            <input type="submit" value="Submit" class="btn btn-success float-left-padding px-3">
          </div>
        </div>
          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->
        
      </div>
      
    
  </section>

  @endsection
