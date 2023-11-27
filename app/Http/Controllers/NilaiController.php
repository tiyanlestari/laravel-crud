<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::with('Matkul','Mahasiswa')->get();

        $nama_mahasiswa = [];
        $nama_matkul = [];

        foreach ($nilai as  $data) {
            $nama_mahasiswa[] = Mahasiswa::where('id',$data->mahasiswa_id)->first()->nama_mahasiswa;
            $nama_matkul[] = Matkul::where('id',$data->matkul_id)->first()->nama_matkul;
        }
        $mahasiswa = Mahasiswa::all();
        $matkul = Matkul::all();

        return view('nilai', compact('nilai','mahasiswa', 'matkul','nama_mahasiswa','nama_matkul'));
    }

    public function create()
    {
        return view('nilai.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'matkul_id' => 'required',
            'mahasiswa_id' => 'required',
            'nilai' => 'required|numeric|min:0|integer|max:100',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ], [
            'matkul_id.required' => 'ID Matkul wajib diisi!',
            'mahasiswa_id.required' => 'Nama Mahasiswa wajib diisi!',
            'nilai.required' => 'Nilai wajib diisi!',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai tidak boleh kurang dari 0',
            'nilai.integer' => 'Nilai harus berupa bilangan bulat',
            'nilai.max' => 'Nilai tidak boleh lebih dari 100',
        ]);

        $nilai = new Nilai([
            'matkul_id' => $request->matkul_id,
            'mahasiswa_id'=> $request->mahasiswa_id,
            // 'nama_mahasiswa' => $request->input('nama_mahasiswa'),
            'nilai' => $request->input('nilai'),
            // Sesuaikan kolom lain sesuai kebutuhan
        ]);

        $nilai->save();

        // dd($nilai);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);

        return view('nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_matkul' => 'required',
            'nilai' => 'required|numeric|min:0|integer|max:100',
            // ...
        ], [
            'nilai.required' => 'Nilai harus diisi',
            'nilai.numeric' => 'Nilai harus berupa angka.',
            'nilai.min' => 'Nilai tidak boleh kurang dari 0',
            'nilai.integer' => 'Nilai harus berupa bilangan bulat',
            'nilai.max' => 'Nilai tidak boleh lebih dari 100',
        ]);


        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'matkul_id' => $request->input('id_matkul'),
            'nilai' => $request->input('nilai'),
            // Sesuaikan kolom lain sesuai kebutuhan
        ]);

        return redirect()->route('nilai')->with('success', 'Nilai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('nilai')->with('success', 'Nilai berhasil dihapus!');
    }
}
