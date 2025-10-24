<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        $siswa = $user->siswa;
        $pembimbing = $siswa ? $siswa->pembimbing : null;
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        $dudi = $siswa ? $siswa->dudi : null;

        return view("siswa.profile.index", compact('siswa', 'user', 'pembimbing', 'kelas', 'jurusan', 'dudi'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'id_kelas' => 'required|exists:kelas,id',
            'id_jurusan' => 'required|exists:jurusans,id',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:laki-laki,perempuan',
            'gol_darah' => 'required|string|max:3',
            'nomor' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $siswa->update([
            'id_kelas' => $request->id_kelas,
            'id_jurusan' => $request->id_jurusan,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'gol_darah' => $request->gol_darah,
            'nomor' => $request->nomor,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('siswa.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
