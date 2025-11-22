<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Dudi;
use App\Models\Jurusan;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $pembimbing = auth()->user();

        $siswa = $pembimbing->pembimbing()->count();
        $absen = Absen::whereIn('id_siswa', $pembimbing->pembimbing->pluck('id'))->count();

        $kegiatanTerbaru = Kegiatan::whereIn('id_siswa', $pembimbing->pembimbing->pluck('id'))
            ->with('siswa.user')
            ->latest()
            ->take(6)
            ->get();

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $kegiatanBulanan = Kegiatan::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal'),
            DB::raw('COUNT(*) as total')
        )
            ->whereIn('id_siswa', $pembimbing->pembimbing->pluck('id'))
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))
            ->orderBy('tanggal', 'asc')
            ->get();


        // Format data untuk chart
        $labels = $kegiatanBulanan->pluck('tanggal')->map(fn($t) => Carbon::parse($t)->format('d M'));
        $totals = $kegiatanBulanan->pluck('total');


        return view('pembimbing.dashboard', compact('siswa', 'pembimbing', 'absen', 'kegiatanTerbaru', 'labels', 'totals'));
    }

    public function pembimbingDudi()
    {
        return view('pembimbingDudi.dashboard');
    }

    public function siswa()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        if (!$siswa) {
            $totalKegiatan = 0;
            $totalAbsen = 0;

            return view('siswa.dashboard', compact('totalKegiatan', 'totalAbsen'));
        }

        $totalKegiatan = $siswa->kegiatan()->count();
        $totalAbsen = $siswa->absen()->count();

        return view('siswa.dashboard', compact('totalKegiatan', 'totalAbsen'));

    }
}
    