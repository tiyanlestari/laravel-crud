@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Mata Kuliah</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMatkulModal">Tambah Mata
                Kuliah</button>
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
                    <th scope="col">Nama Mata Kuliah</th>
                    <th scope="col">SKS</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matkul as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_matkul }}</td>
                        <td>Rp. {{ number_format($item->SKS, 0, ',', '.') }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editMatkulModal{{ $item->id }}">Edit</a>

                            <form action="{{ route('matkul.destroy', $item->id) }}" method="POST" style="display: inline">
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

    <div class="modal fade" id="tambahMatkulModal" tabindex="-1" aria-labelledby="tambahMatkulModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMatkulModalLabel">Tambah Mata Kuliah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulir Tambah Mata Kuliah -->
                <form action="{{ route('matkul.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_matkul" class="form-label">Nama Mata Kuliah:</label>
                        <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" required>
                    </div>
                    <div class="mb-3">
                        <label for="SKS" class="form-label">SKS:</label>
                        <input type="number" class="form-control" id="SKS" name="SKS">
                        @error('SKS')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Tambahkan input form lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>


            @foreach ($matkul as $item)
                <div class="modal fade" id="editMatkulModal{{ $item->id }}" tabindex="-1"
                    aria-labelledby="editMatkulModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMatkulModalLabel{{ $item->id }}">Edit Mata Kuliah</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Formulir Edit Mata Kuliah -->
                                <form action="{{ route('matkul.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="edit_nama_matkul" class="form-label">Nama Mata Kuliah:</label>
                                        <input type="text" class="form-control" id="edit_nama_matkul" name="nama_matkul"
                                            value="{{ $item->nama_matkul }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_SKS" class="form-label">SKS:</label>
                                        <input type="number" class="form-control" id="" name="SKSedit"
                                            value="{{ $item->SKS }}">
                                        @error('SKSedit')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
