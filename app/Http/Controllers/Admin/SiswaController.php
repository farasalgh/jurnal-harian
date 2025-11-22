<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    //
    public function index()
    {
        $siswa = Siswa::with('user', 'kelas', 'jurusan', 'dudi', 'pembimbing')->get();
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

        return view('admin.siswa.edit', compact('siswa', 'userData', 'siswaData', 'kelas', 'jurusan', 'dudi', 'pembimbing'));
    }

    public function update(Request $request, User $siswa)
    {
        $request->validate([
            'name' => 'required|string|',
            'email' => 'required|email|unique:users,email,' . $siswa->id,
            'password' => 'nullable|string|min:6',
            'nis' => 'required|unique:siswas,nis,' . $siswa->id,
            'id_kelas' => 'required',
            'id_pembimbing' => 'required',
            'id_jurusan' => 'required',
            'id_dudi' => 'required',
        ]);

        $siswa->name = $request->name;
        $siswa->email = $request->email;

        if ($request->filled('password')) {
            $siswa->password = Hash::make($request->password);
        }
        ;

        $siswa->save();

        $siswaData = $siswa->siswa;

        $siswaData->nis = $request->nis;
        $siswaData->id_kelas = $request->id_kelas;
        $siswaData->id_jurusan = $request->id_jurusan;
        $siswaData->id_dudi = $request->id_dudi;
        $siswaData->id_pembimbing = $request->id_pembimbing;
        $siswaData->save();

        return redirect()->route('admin.siswa.index')->with('success', 'Berhasil mengupdate data');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_jurusan' => 'required',
            'nis' => 'required|unique:siswas,nis',
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

    public function destroy(Siswa $siswa)
    {
        $user = User::find($siswa->id_users);

        $kegiatans = Kegiatan::where('id_siswa', $siswa->id)->get();
        foreach ($kegiatans as $kegiatan) {
            if ($kegiatan->dokumentasi) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }
        }

        if ($siswa->photo_profile) {
            Storage::disk('public')->delete($siswa->photo_profile);
        }
        $user->delete();
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Berhasil menghapus data ini');
    }
}
