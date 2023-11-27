<?php

namespace App\Http\Controllers;

use App\Models\Dosen;

use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programstudi = Program::all();
        return view('programstudi', compact('programstudi'));
    }

    public function create()
    {
        return view('Program.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_program_studi' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

       Program::create($request->all());

        return redirect()->route('programstudi')->with('success', 'Program Studi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $programstudi = Program::findOrFail($id);
        return view('Program.edit', compact('programstudi'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_program_studi' => 'required',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        $Program = Program::findOrFail($id);
        $Program->update($request->all());

        return redirect()->route('programstudi')->with('success', 'Program Studi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $Program = Program::findOrFail($id);

        try {
            //code...
            $Program->delete();
        } catch (\Throwable $th) {
            //throw $th;

            return redirect()->route('programstudi')->with('error', 'Program Studi Masih digunakan');
        }

        return redirect()->route('programstudi')->with('success', 'Program Studi berhasil dihapus!');
    }
}
