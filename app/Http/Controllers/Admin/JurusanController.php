<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    //
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|unique:jurusans,jurusan',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('admin.jurusan.index')->with('success', 'Berhasil menambahkan jurusan');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'jurusan' => 'required|unique:jurusans,jurusan,' . $jurusan->id,
        ]);

        $data = [
            'jurusan'=> $request->jurusan,
        ];

        $jurusan->update($data);

        return redirect()->route('admin.jurusan.index')->with('success', 'Sukeses mengupdate data');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success','Sukses menghapus data');
    }
}
