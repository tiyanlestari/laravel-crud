@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Mahasiswa</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal">Tambah
                Mahasiswa</button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Nama Program Studi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Mahasiswa"
                                    style="max-width: 100px; max-height: 100px;">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        {{-- @dd($item) --}}
                        <td>{{ $item->nama_mahasiswa }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->program->nama_program_studi }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.update', $item->id) }}" class="btn btn-warning btn-sm"
                                data-bs-toggle="modal" data-bs-target="#editMahasiswaModal{{ $item->id }}">Edit</a>

                            <form id="deleteForm{{ $item->id }}" action="{{ route('mahasiswa.destroy', $item->id) }}"
                                method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(event)">
                                    <i class="bi bi-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="tambahMahasiswaModal" tabindex="-1" aria-labelledby="tambahMahasiswaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahMahasiswaModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulir Tambah Mahasiswa -->
                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa:</label>
                            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="program_studi" class="form-label">Program Studi:</label>
                            <select class="form-control" id="program_studi" name="program_id" required>
                                <option value="" selected disabled>Pilih Program Studi</option>
                                @foreach ($program as $data)
                                    <option value="{{ $data->id }}"
                                        {{ old('program_id') == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_program_studi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="mahasiswa_foto" class="form-label">Foto Mahasiswa:</label>
                            <input type="file" class="form-control" id="mahasiswa_foto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($mahasiswa as $item)
        <!-- Modal Edit Mahasiswa -->
        <div class="modal fade" id="editMahasiswaModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editMahasiswaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMahasiswaModalLabel">Edit Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulir Edit Mahasiswa -->
                        <form action="{{ route('mahasiswa.update', $item->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="edit_nama" class="form-label">Nama Mahasiswa:</label>
                                <input type="text" class="form-control" id="edit_nama" name="nama_mahasiswa"
                                    value="{{ $item->nama_mahasiswa }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_alamat" class="form-label">Alamat:</label>
                                <textarea class="form-control" id="edit_alamat" name="alamat" required>{{ $item->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                                <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir"
                                    value="{{ $item->tanggal_lahir }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="program_studi" class="form-label">Program Studi:</label>
                                <select class="form-control" id="program_studi" name="program_id" required>
                                    <option value="" selected disabled>Pilih Program Studi</option>
                                    @foreach ($program as $data)
                                        <option value="{{ $data->id }}"
                                            {{ $item->program_id == $data->id ? 'selected' : '' }}>
                                            {{ $data->nama_program_studi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_foto_mahasiswa" class="form-label">Foto Mahasiswa:</label>
                                <input type="file" class="form-control" id="edit_foto_mahasiswa" name="foto"
                                    value="{{ $item->foto_mahasiswa }}">
                            </div>

                            @if ($item->foto)

                                <div class="mb-3">
                                    <label for="current_photo" class="form-label">Foto Mahasiswa Sekarang:</label>
                                    <img src="{{ asset('storage/' . $item->foto) }}"
                                        alt="Current Photo" class="img-thumbnail" width="100">
                                </div>
                            @endif
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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Data masih digunakan"
            })
        </script>
    @endif

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
