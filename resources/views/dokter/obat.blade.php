@extends('components.layoutdokter')

@section('content')
<section class="content">
    <h1>Obat</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Obat</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.obat') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_obat">Nama Obat</label>
                            <input type="text" id="nama_obat" name="nama_obat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kemasan">Kemasan</label>
                            <input type="text" id="kemasan" name="kemasan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" id="harga" name="harga" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Tambah Obat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL OBAT -->
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Obat</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $index => $obat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $obat->id }}</td>
                            <td>{{ $obat->nama_obat }}</td>
                            <td>{{ $obat->kemasan }}</td>
                            <td>{{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-warning edit-btn" 
                                    data-id="{{ $obat->id }}" 
                                    data-nama="{{ $obat->nama_obat }}" 
                                    data-kemasan="{{ $obat->kemasan }}" 
                                    data-harga="{{ $obat->harga }}"
                                    data-toggle="modal" 
                                    data-target="#editModal">Edit</button>

                                <form action="{{ route('dokter.obat.delete', $obat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL EDIT OBAT -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="edit_nama_obat">Nama Obat</label>
                            <input type="text" id="edit_nama_obat" name="nama_obat" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kemasan">Kemasan</label>
                            <input type="text" id="edit_kemasan" name="kemasan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_harga">Harga</label>
                            <input type="number" id="edit_harga" name="harga" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-btn");
        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const nama = this.getAttribute("data-nama");
                const kemasan = this.getAttribute("data-kemasan");
                const harga = this.getAttribute("data-harga");

                document.getElementById("edit_nama_obat").value = nama;
                document.getElementById("edit_kemasan").value = kemasan;
                document.getElementById("edit_harga").value = harga;

                document.getElementById("editForm").action = "/dokter/obat/update/" + id;
            });
        });
    });
</script>

@endsection
