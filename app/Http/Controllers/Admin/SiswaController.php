<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    //
    public function index()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();
        $pembimbing = User::where('role', 'pembimbing')->get();
        return view('admin.siswa.create', compact('kelas', 'jurusan', 'dudi', 'pembimbing'));
    }

    public function edit(User $siswa)
    {
        $userData = $siswa->only(['id', 'name', 'email']);

        $siswaData = $siswa->siswa;
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = Dudi::all();
        $pembimbing = User::where('role', 'pembimbing')->get();

        return view('admin.siswa.edit', compact('userData', 'siswaData', 'kelas','jurusan','dudi', 'pembimbing'));
    }

    public function update(User $siswa)
    {  
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'nis' => 'required',
            'id_dudi' => 'required',
            'id_pembimbing' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'id_users' => $user->id,
            'id_kelas' => $request->id_kelas,
            'id_jurusan' => $request->id_jurusan,
            'nis' => $request->nis,
            'id_dudi' => $request->id_dudi,
            'id_pembimbing' => $request->id_pembimbing,
            'name' => $request->name,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'berhasil menambahkan data siswa');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.siswa.index')->with('success','Berhasil menghapus data ini');
    }
}
