<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    //
    public function index()
    {
        $kelas = Kelas::all();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
        ]);

        Kelas::create([
            'kelas'=> $request->kelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Berhasil menambahkan kelas');
    }

    public function edit($id)   
    {
        $kelas = Kelas::find($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
       $kelas = Kelas::find($id);

       $kelas->update($request->all());

       return redirect()->route('admin.kelas.index')->with('success','Berhasil ubah kelas');
    }

    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Berhasil menghapus kelas');
    }
}
