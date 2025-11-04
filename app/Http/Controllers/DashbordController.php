<?php

namespace App\Http\Controllers;

use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    //
    public function admin()
    {
        $totalKelas = Kelas::count();
        $totalJurusan = Jurusan::count();
        $totalDudi = Dudi::count();
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        return view('admin.dashboard', compact('totalKelas', 'totalJurusan', 'totalDudi', 'totalPembimbing', 'totalSiswa'));
    }

    public function pembimbing()
    {
        $totalKelas = Kelas::count();
        $totalJurusan = Jurusan::count();
        $totalDudi = Dudi::count();
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        return view('pembimbing.dashboard', compact('totalKelas', 'totalJurusan', 'totalDudi', 'totalPembimbing', 'totalSiswa'));
    }

    public function siswa()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $totalKegiatan = $siswa->kegiatan()->count();
        $totalAbsen = $siswa->absen()->count();

        return view('siswa.dashboard', compact('totalKegiatan', 'totalAbsen'));

    }
}
