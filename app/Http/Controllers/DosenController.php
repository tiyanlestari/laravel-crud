<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $Dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id_dosen)
    {
        $request->validate([
            'nama_dosen' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        $Dosen = Dosen::findOrFail($id_dosen);
        $Dosen->update($request->all());

        return redirect()->route('dosen')->with('success', 'Dosen berhasil diperbarui!');
    }

    public function destroy($id_dosen)
    {
        $Dosen = Dosen::findOrFail($id_dosen);
        $Dosen->delete();

        return redirect()->route('dosen')->with('success', 'Mata Kuliah berhasil dihapus!');
    }
}
