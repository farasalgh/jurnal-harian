<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        if (!$siswa) {
            $kegiatan = collect();

            return view('siswa.kegiatan.index', compact('kegiatan'));
        }

        $kegiatan = $siswa->kegiatan()
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                // Format: 2025-10
                return Carbon::parse($item->created_at)->format('Y-m');
            })
            ->map(function ($groupedMonth) {
                // Di dalam tiap bulan, kelompokkan berdasarkan minggu ke-n
                return $groupedMonth->groupBy(function ($item) {
                    return ceil(Carbon::parse($item->created_at)->weekOfMonth);
                });
            });

        return view('siswa.kegiatan.index', compact('user', 'siswa', 'kegiatan'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('siswa.kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        $request->validate([
            'tanggal_kegiatan' => 'required|date',
            'mulai_kegiatan' => 'required',
            'akhir_kegiatan' => 'required',
            'dokumentasi' => 'required|image|max:2048',
            'keterangan_kegiatan' => 'required|string',
        ]);

        $data = [
            'id_siswa' => $siswa->id,
            'tanggal' => $request->tanggal_kegiatan,
            'mulai_kegiatan' => $request->mulai_kegiatan,
            'selesai_kegiatan' => $request->akhir_kegiatan,
            'keterangan_kegiatan' => $request->keterangan_kegiatan,
        ];

        if ($request->hasFile('dokumentasi')) {
            $imagePath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $data['dokumentasi'] = $imagePath;
        }

        Kegiatan::create($data);

        return redirect()->route('siswa.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = auth()->user();

        $siswa = $user->siswa;

        $kegiatan = Kegiatan::findOrFail($id);
        return view('siswa.kegiatan.detail', compact('user', 'siswa', 'kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($id);
        return view('siswa.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'mulai_kegiatan' => 'required',
            'selesai_kegiatan' => 'required',
            'dokumentasi' => 'nullable|image|max:2048',
            'keterangan_kegiatan' => 'required|string',
        ]);

        $data = $request->only([
            'tanggal',
            'mulai_kegiatan',
            'selesai_kegiatan',
            'keterangan_kegiatan',
        ]);

        if ($request->hasFile('dokumentasi')) {
            if (
                $kegiatan->dokumentasi && Storage::disk('public')->exists
                ($kegiatan->dokumentasi)
            ) {
                Storage::disk('public')->delete($kegiatan->dokumentasi);
            }
            $imagePath = $request->file('dokumentasi')->store('dokumentasi', 'public');
            $data['dokumentasi'] = $imagePath;
        }

        $kegiatan->update($data);
        return redirect()->route('siswa.kegiatan.index')->with('success', 'Berhasil mengupdate data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        if ($kegiatan->dokumentasi) {
            Storage::disk('public')->delete($kegiatan->dokumentasi);
        }
        $kegiatan->delete();

        return redirect()->route('siswa.kegiatan.index')->with('success', 'berhasil menghapus kegiatan');
    }
}
