@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.obat') }}" class="nav-link">
                <i class="nav-icon fas fa-pills"></i>
                <p>
                    Obat
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.dokter') }}" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                    Dokter
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pasien') }}" class="nav-link">
                <i class="nav-icon fas fa-procedures"></i>
                <p>
                    Pasien
                    <span class="right badge bg-success">Admin</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.poliMaster') }}" class="nav-link">
                <i class="nav-icon fas fa-hospital"></i>
                <p>
                    Poli
                    <span class="right badge bg-success">Admin</span>
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
    <div class="container mt-4">
        <h1 class="display-4 text-primary">Edit Obat</h1>

        <!-- Tampilkan pesan error -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit Obat -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Form Edit Obat</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/obat/update/' . $obat->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_obat">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="form-control"
                            value="{{ $obat->nama_obat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kemasan">Kemasan</label>
                        <input type="text" name="kemasan" id="kemasan" class="form-control" value="{{ $obat->kemasan }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" value="{{ $obat->harga }}"
                            required>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.obat') }}" class="btn btn-secondary ml-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection