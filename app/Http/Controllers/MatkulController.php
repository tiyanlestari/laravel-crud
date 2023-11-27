<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function index()
    {
        $matkul = Matkul::all();
        return view('matkul', compact('matkul'));
    }

    public function create()
    {
        return view('matkul.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_matkul' => 'required',
            'SKS' => 'required|numeric|min:0|integer',
        ], [
            'nama_matkul.required' => 'Nama Mata Kuliah harus diisi.',
            'SKS.required' => 'SKS harus diisi.',
            'SKS.numeric' => 'SKS harus berupa angka.',
            'SKS.min'=>'SKS tidak boleh kurang dari 0',
            'SKS.integer' => 'SKS harus berupa bilangan bulat',
        ]);
        // dd($request->all);

        Matkul::create([
            'nama_matkul' => $request->nama_matkul,
            'SKS' => $request->SKS
        ]);

        return redirect()->route('matkul')->with('success', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        return view('matkul.edit', compact('matkul'));
    }

    public function update(Request $request, $id_matkul)
    {
        // dd($request->all());
        // dd($id_matkul);
        $request->validate([
            'nama_matkul' => 'required',
            'SKSedit' => 'required|numeric|min:0|integer',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ], [
            'nama_matkul.required' => 'Nama Mata Kuliah harus diisi.',
            'SKSedit.required' => 'SKS harus diisi.',
            'SKSedit.numeric' => 'SKS harus berupa angka.',
            'SKSedit.min' => 'SKS tidak boleh kurang dari 0',
            'SKSedit.integer' => 'SKS harus berupa bilangan bulat',
        ]);

        $matkul = Matkul::where('id',$id_matkul)->first();
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->SKS = $request->SKSedit  ;
        $matkul->save();
        // $matkul->update($request->all());

        return redirect()->route('matkul')->with('success', 'Mata Kuliah berhasil diperbarui!');
    }

    public function destroy($id_matkul)
    {
        $matkul = Matkul::findOrFail($id_matkul);
        try {
            $matkul->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data masih digunakan atau terjadi kesalahan');
        }

        // $matkul->delete();

        return redirect()->route('matkul')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
