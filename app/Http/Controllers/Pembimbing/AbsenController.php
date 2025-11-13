<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembimbing = auth()->user();
        $siswaIds = $pembimbing->pembimbing()->pluck('id');

        $absens = Absen::whereIn('id_siswa', $siswaIds)
            ->select('tanggal_absensi', 'status', DB::raw('count(*) as total'))
            ->groupBy('tanggal_absensi', 'status')
            ->get();

        $events = $absens->map(function ($absen) {
            return [
                'title' => ucfirst($absen->status) . ': ' . $absen->total . ' siswa',
                'start' => $absen->tanggal_absensi,
                'color' => match ($absen->status) {
                    'hadir' => '#28a745',
                    'izin' => '#ffc107',
                    'sakit' => '#17a2b8',
                    'alpa' => '#dc3545',
                    default => '#6c757d',
                },
            ];
        });

        return view('pembimbing.absen.index', compact('events'));
    }

    public function getByDate(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $pembimbing = auth()->user();

        $siswaIds = $pembimbing->pembimbing()->pluck('id');

        $absens = Absen::whereIn('id_siswa', $siswaIds)
            ->with(['siswa.user'])
            ->whereDate('tanggal_absensi', $tanggal)
            ->get();

        if ($absens->isEmpty()) {
            return response()->json([]);
        }

        $data = $absens->map(function ($absen) {
            return [
                'nama' => $absen->siswa->user->name ?? 'Tidak diketahui',
                'status' => $absen->status ?? '-',
            ];
        });

        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
