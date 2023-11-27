@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Program Studi</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProgramStudiModal">Tambah Program Studi</button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Program Studi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programstudi as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->nama_program_studi }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProgramStudiModal{{ $item->id }}">Edit</a>

                            <form action="{{ route('programstudi.destroy', $item->id) }}" method="POST"
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


    <div class="modal fade" id="tambahProgramStudiModal" tabindex="-1" aria-labelledby="tambahProgramStudiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahProgramStudiModalLabel">Tambah Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ route('programstudi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_program_studi" class="form-label">Nama Program Studi:</label>
                            <input type="text" class="form-control" id="nama_program_studi" name="nama_program_studi"
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

  @foreach ($programstudi as $item)
    <div class="modal fade" id="editProgramStudiModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="editProgramStudiModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProgramStudiModalLabel{{ $item->id }}">Edit Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('programstudi.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="edit_nama_program_studi" class="form-label">Nama Program Studi:</label>
                            <input type="text" class="form-control" id="edit_nama_program_studi"
                                name="nama_program_studi" value="{{ $item->nama_program_studi }}" required>
                        </div>
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
