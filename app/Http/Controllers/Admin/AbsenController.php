<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absens = Absen::with(['siswa'])->get();

        $events = $absens->map(function ($absen) {
            return [
                'id' => $absen->id,
                'title' => $absen->siswa->user->name . ' - ' . ucfirst($absen->status),
                'start' => $absen->tanggal_absensi,
                'color' => match ($absen->status) {
                    'hadir' => '#28a745',
                    'izin' => '#ffc107',
                    'sakit' => '#17a2b8',
                    'alpa' => '#dc3545',
                },
            ];
        });

        return view('siswa.absen.index', compact('events'));
    }


     public function getByDate(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $user = $request->user();

        $absen = $user->siswa->absen()
            ->whereDate('tanggal_absensi', $tanggal)
            ->first();

        if ($absen) {
            return response()->json([
                'status' => $absen->status,
                'keterangan' => $absen->keterangan,
                'tanggal_absensi' => $absen->tanggal_absensi,
                'jam_masuk' => $absen->jam_masuk,
                'jam_pulang' => $absen->jam_pulang,
            ]);
        }

        return response()->json(['message' => 'Tidak ada data absen di tanggal ini.'], 404);
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
