<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return view("siswa.profile.index", [
                'siswa' => null,
                'user' => $user,
                'pembimbing' => null,
                'kelas' => collect(),
                'jurusan' => collect(),
                'dudi' => null,
                'kegiatan' => collect(),
            ]);
        }

        return view("siswa.profile.index", [
            'siswa' => $siswa,
            'user' => $user,
            'pembimbing' => $siswa->pembimbing,
            'kelas' => Kelas::all(),
            'jurusan' => Jurusan::all(),
            'dudi' => $siswa->dudi,
            'kegiatan' => $siswa->kegiatan,
        ]);

    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'photo_profile' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'gol_darah' => 'nullable|string|max:3',
            'nomor' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        // Update user data
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ];

        if ($request->filled('password')) {
            $dataUser['password'] = Hash::make($request->password);
        }

        // Update siswa data
        $dataSiswa = [
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gender' => $request->gender,
            'gol_darah' => $request->gol_darah,
            'nomor' => $request->nomor,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('photo_profile')) {
            $photoPath = $request->file('photo_profile')->store('profile_photos', 'public');
            if ($siswa->photo_profile) {
                Storage::disk('public')->delete($siswa->photo_profile);
            }
            $dataSiswa['photo_profile'] = $photoPath;
        }

        $user->update($dataUser);
        $siswa->update($dataSiswa);

        return redirect()->route('siswa.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

}
