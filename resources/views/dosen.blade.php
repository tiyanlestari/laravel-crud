@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Dosen</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDosenModal">Tambah Dosen</button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosen as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_dosen }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDosenModal{{ $item->id_dosen }}">Edit</a>

                            <form action="{{ route('dosen.destroy', $item->id_dosen) }}" method="POST"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Mata Kuliah -->
    <div class="modal fade" id="tambahDosenModal" tabindex="-1" aria-labelledby="tambahDosenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDosenModalLabel">Tambah Dosen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulir Tambah Mata Kuliah -->
                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_dosen" class="form-label">Nama Dosen:</label>
                            <input type="text" class="form-control" id="nama_dosen" name="nama_dosen"
                                required>
                        </div>
                        <!-- Tambahkan input form lainnya sesuai kebutuhan -->

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Matkul/index.blade.php -->

    <!-- Modal Edit Mata Kuliah -->
    @foreach ($dosen as $item)
        <div class="modal fade" id="editDosenModal{{ $item->id_dosen }}" tabindex="-1"
            aria-labelledby="editDosenModalLabel{{ $item->id_dosen }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDosenModalLabel{{ $item->id_dosen }}">Edit Dosen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir Edit Mata Kuliah -->
                        <form action="{{ route('dosen.update', $item->id_dosen) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_nama_dosen" class="form-label">Nama Dosen:</label>
                                <input type="text" class="form-control" id="edit_nama_dosen"
                                    name="nama_dosen" value="{{ $item->nama_dosen }}" required>
                            </div>
                            <!-- Tambahkan input form lainnya sesuai kebutuhan -->

                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




    <!-- Include SweetAlert styles -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    event.target.closest('form').submit();
                }
            });
        }
    </script>
@endsection
