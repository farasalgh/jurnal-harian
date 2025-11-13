<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembimbing = auth()->user();

        $siswaIds = $pembimbing->pembimbing()->pluck('id');

        $kegiatan = Kegiatan::whereIn('id_siswa', $siswaIds)
            ->with(['siswa.user']) 
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('Y-m');
            })
            ->map(function ($groupedMonth) {
                return $groupedMonth->groupBy(function ($item) {
                    return ceil(Carbon::parse($item->created_at)->weekOfMonth);
                });
            });

        return view('pembimbing.kegiatan.index', compact('pembimbing', 'kegiatan'));
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
        $pembimbing = auth()->user();

        $siswa = $pembimbing->pembimbing()->pluck('id');
        $kegiatan = Kegiatan::where('id', $id)
            ->whereIn('id_siswa', $siswa)
            ->with('siswa.user')
            ->firstOrFail();

        return view('pembimbing.kegiatan.detail', compact('pembimbing', 'kegiatan'));
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
        $request->validate([
            'catatan_pembimbing' => 'required|string',
        ]);

        $pembimbing = auth()->user();
        $siswa = $pembimbing->pembimbing()->pluck('id');

        $kegiatan = Kegiatan::where('id', $id)
            ->whereIn('id_siswa', $siswa)
            ->firstOrFail();

        $kegiatan->update([
            'catatan_pembimbing' => $request->catatan_pembimbing,
        ]);

        return redirect()->back()->with('success', 'success menambahkan catatan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
