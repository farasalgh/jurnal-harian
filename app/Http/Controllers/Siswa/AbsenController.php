<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                    'libur' => '#333',
                },
            ];
        });

        return view('siswa.absen.index', compact('events', 'absens'));
    }

    public function getByDate(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $user = auth()->user();

        if (!$user->siswa) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 404);
        }

        $absen = $user->siswa->absen()
            ->whereDate('tanggal_absensi', $tanggal)
            ->first();

        if ($absen) {
            return response()->json([
                'id' => $absen->id,
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
        $request->validate([
            'tanggal_absensi' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|string',
        ]);

        $siswa = auth()->user()->siswa ?? null;

        $today = Carbon::today();

        if (Absen::where('id_siswa', Auth::user()->siswa->id)->where('tanggal_absensi', $today)->exists()) {
            return back()->with('error', 'Anda sudah mengisi absen');
        }

        $lastAbsen = Absen::where('id_siswa', Auth::user()->siswa->id)
            ->orderByDesc('tanggal_absensi', 'desc')
            ->first();

        if ($lastAbsen) {
            $nextDate = Carbon::parse($lastAbsen->tanggal_absensi)->addDay();
            while ($nextDate->lt($today)) {
                if (!in_array($nextDate->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY])) {
                    Absen::create([
                        'id_siswa' => $siswa->id,
                        'tanggal_absensi' => $nextDate->toDateString(),
                        'status' => 'alpa',
                        'keterangan' => 'tidak melakukan absensi',
                    ]);
                }
                $nextDate->addDay();
            }
        }

        Absen::updateOrCreate(
            [
                'tanggal_absensi' => $request->tanggal_absensi,
                'id_siswa' => $siswa->id,
            ],
            [
                'jam_masuk' => now()->format('H:i'),
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]
        );

        return response()->json(['success' => 'true']);
    }

    public function absenPulang($id)
    {
        $absensi = Absen::findOrFail($id);

        if ($absensi->status !== 'hadir') {
            return back()->with('error', 'Absen pulang hanya untuk siswa yang hadir');
        }

        if ($absensi->jam_pulang !== null) {
            return back()->with('error', 'sudah absen pulang sbelumnya');
        }

        $absensi->update([
            'jam_pulang' => now()->format('H:i:s'),
        ]);

        return back()->with('success', 'Absen pulang berhasil');
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
