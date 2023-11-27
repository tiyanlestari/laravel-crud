@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h2>Data Nilai</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahNilaiModal">Tambah Nilai</button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
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
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">Nilai</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($nilai as $i => $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $nama_matkul[$i] }}</td>
                        <td>{{ $nama_mahasiswa[$i] }}</td>
                        <td>{{ $item->nilai }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editNilaiModal{{ $item->id }}">Edit</a>
                            <div class="modal fade" id="editNilaiModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editNilaiModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editNilaiModalLabel{{ $item->id }}">Edit Nilai
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulir Edit Nilai -->
                                            <form action="{{ route('nilai.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="id_matkul" class="form-label">Nama Mata Kuliah:</label>
                                                    <select class="form-control" id="id_matkul" name="id_matkul">
                                                        @foreach ($matkul as $dataMatkul)
                                                            <option value="{{ $dataMatkul->id }}"
                                                                {{ $dataMatkul->id == $item->id_matkul ? 'selected' : '' }}>
                                                                {{ $nama_matkul[$i] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mahasiswa_id" class="form-label">Nama Mahasiswa:</label>
                                                    <select class="form-control" id="mahasiswa_id" name="mahasiswa_id">
                                                        @foreach ($mahasiswa as $dataMahasiswa)
                                                            <option value="{{ $dataMahasiswa->id }}"
                                                                {{ $dataMahasiswa->id == $item->mahasiswa_id ? 'selected' : '' }}>
                                                                {{ $dataMahasiswa->nama_mahasiswa }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_nilai" class="form-label">Nilai:</label>
                                                    <input type="number" class="form-control" id="edit_nilai"
                                                        name="nilai" value="{{ $item->nilai }}" max="100">
                                                    @error('nilai')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete(event)">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    nnn
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="tambahNilaiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahNilaiModalLabel">Tambah Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulir Tambah Nilai -->
                    <form action="{{ route('nilai.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="matkul_id" class="form-label">Nama Mata Kuliah:</label>
                            <select class="form-control @error('matkul_id') @enderror " id="matkul_id" name="matkul_id">
                                @foreach ($matkul as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_matkul }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mahasiswa_id" class="form-label">Nama Mahasiswa:</label>
                            <select class="form-control @error('mahasiswa_id') @enderror" id="mahasiswa_id"
                                name="mahasiswa_id">
                                @foreach ($mahasiswa as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_mahasiswa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nilai" class="form-label">Nilai:</label>
                            <input type="number" class="form-control @error('nilai') is-invalid @enderror" id="nilai"
                                name="nilai" max="100">
                            @error('nilai')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Matkul/index.blade.php -->






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
