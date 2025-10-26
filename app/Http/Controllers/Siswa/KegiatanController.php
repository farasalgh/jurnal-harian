<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();

        $siswa = $user->siswa;
        $kegiatan = $siswa->kegiatan;
        return view('siswa.kegiatan.index', compact('user', 'siswa', 'kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa; 

        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'mulai_kegiatan' => 'required',
            'akhir_kegiatan' => 'required',
            'dokumentasi' => 'nullable|image|max:2048',
            'keterangan_kegiatan' => 'required|string',
        ]);

        $data = [
            'id_siswa' => $siswa->id,
            'tanggal' => $request->tanggal_kegiatan,
            'mulai_kegiatan' => $request->mulai_kegiatan,
            'selesai_kegiatan' => $request->akhir_kegiatan,
            'keterangan_kegiatan' => $request->keterangan_kegiatan,
        ];

        if ($request->hasFile('dokumentasi')) {
            $imagePath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $data['dokumentasi'] = $imagePath;
        }

        Kegiatan::create($data);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        return redirect()->route('siswa.kegiatan.index')->with('success','berhasil menghapus kegiatan');
    }
}
