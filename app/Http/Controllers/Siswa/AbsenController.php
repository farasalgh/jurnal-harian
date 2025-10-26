<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Log;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $siswa = $user->siswa;

        $absens = $siswa->absen;

        $events = $absens->map(function ($absen) {
            return [
                'id' => $absen->id,
                'title' => ucfirst($absen->status),
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
        $user = auth()->user();

        $idSiswa = $user->siswa->id ?? null;

        if (!$idSiswa) {
            return response()->json(['error' => 'Siswa tidak ditemukan.'], 404);
        }

        $absen = Absen::where('id_siswa', $idSiswa)
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

        return response()->json(null);
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
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|string',
        ]);

        $siswa = auth()->user()->siswa ?? null;

        Absen::updateOrCreate(
            [
                'tanggal_absensi' => $request->tanggal_absensi,
                'id_siswa' => $siswa->id,
            ],
            [
                'jam_masuk' => now()->format('H:i'),
                'jam_pulang' => now()->format('H:i'),
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]
        );

        return response()->json(['success' => 'true']);
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
