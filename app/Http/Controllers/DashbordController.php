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
        $totalJurusan = Jurusan ::count();
        $totalDudi = Dudi::count();
        $totalPembimbing = User::where('role', 'pembimbing')->count();
        $totalSiswa = User::where('role', 'siswa')->count();
        return view('admin.dashboard',compact('totalKelas','totalJurusan','totalDudi','totalPembimbing','totalSiswa'));

        
    }

    public function pembimbing()
    {
        return view('pembimbing.dashboard');
    }

    public function siswa()
    {
        return view('siswa.dashboard');
    }
}
