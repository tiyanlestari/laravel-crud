<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\MatkulMahasiswa;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $program = Program::all();
        $mahasiswa = Mahasiswa::with('Program')->get();
        return view("mahasiswa", compact("mahasiswa", "program"));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'program_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'tanggal_lahir.required' => 'tanggal lahir harus diisi',
            'program_id.required' => 'Program Studi harus diisi',
            'foto.required' => 'foto harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif',
        ]);

        Mahasiswa::create([
            'foto' => $request->file('foto')->store('mahasiswa_foto', 'public'),
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'program_id' => $request->program_id
        ]);

        return redirect()->route('mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mahasiswa' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'program_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_mahasiswa.required' => 'nama maha siswa harus di isi',
            'tanggal_lahir.required' => 'tanggal lahir harus diisi',
            'program_id.required' => 'Program Studi harus diisi',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2 MB',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($mahasiswa->foto);
            $fotoPath = $request->file('foto')->store('mahasiswa_foto', 'public');
            $mahasiswa->update(['foto' => $fotoPath]);
        }

        $mahasiswa->update([
            'nama_mahasiswa' => $request->input('nama_mahasiswa'),
            'alamat' => $request->input('alamat'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'program_id' => $request->input('program_id'),
        ]);

        return redirect()->route('mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa, string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        try {
            if ($mahasiswa->foto) {
                Storage::delete('public/' . $mahasiswa->foto);
            }

            $mahasiswa->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data masih digunakan atau terjadi kesalahan');
        }

        return redirect()->back()->with('success', 'Data Mahasiswa berhasil dihapus');
    }
}
