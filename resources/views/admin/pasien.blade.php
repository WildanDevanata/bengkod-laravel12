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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pasien</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPasienModal">
                                <i class="fas fa-plus"></i> Tambah Pasien
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fas fa-check"></i>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="icon fas fa-ban"></i>
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="pasienTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="13%">NO_RM</th>
                                        <th width="20%">No KTP</th>
                                        <th width="20%">Nama</th>
                                        <th width="20%">Email</th>
                                        <th width="12%">No HP</th>
                                        <th width="20%">Alamat</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $pasien)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $pasien->no_rm }}</td>
                                            <td>{{ $pasien->no_ktp }}</td>
                                            <td><strong>{{ $pasien->name }}</strong></td>
                                            <td>{{ $pasien->email }}</td>
                                            <td>{{ $pasien->no_hp ?? '-' }}</td>
                                            <td>{{ $pasien->alamat ?? '-' }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ url('/admin/pasien/edit/' . $pasien->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ url('/admin/pasien/delete/' . $pasien->id) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pasien {{ $pasien->name }}?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="py-4">
                                                    <i class="fas fa-user-injured fa-3x text-muted mb-3"></i>
                                                    <p class="text-muted">Belum ada data pasien</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Pasien -->
    <div class="modal fade" id="addPasienModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-user-plus"></i> Tambah Pasien Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.pasien') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_ktp">NIK <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_ktp') is-invalid @enderror"
                                        id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}"
                                        placeholder="Masukkan NIK pasien" required>
                                    @error('no_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Pasien <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap pasien"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" placeholder="pasien@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_hp">No. HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                        name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Ulangi password" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                                rows="3" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <input type="hidden" name="role" value="pasien">
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $("#pasienTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": true,
                "info": true,
                "paging": true,
                "searching": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                },
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#pasienTable_wrapper .col-md-6:eq(0)');

            // Show modal if there are validation errors
            @if($errors->any())
                $('#addPasienModal').modal('show');
            @endif

            // Auto hide alerts after 5 seconds
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Password confirmation validation
            $('#password_confirmation').on('keyup', function () {
                var password = $('#password').val();
                var confirmPassword = $(this).val();

                if (password !== confirmPassword) {
                    $(this).addClass('is-invalid');
                    if ($(this).next('.invalid-feedback').length === 0) {
                        $(this).after('<div class="invalid-feedback">Password tidak cocok</div>');
                    }
                } else {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                }
            });
        });
    </script>
@endsection