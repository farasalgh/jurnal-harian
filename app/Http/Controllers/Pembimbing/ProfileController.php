<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();

        $siswa = $user->pembimbing()
            ->with(['dudi', 'user', 'kelas'])
            ->get();

        $jumlahSiswa = $siswa->count();
        $jumlahDudi = $user->pembimbing()
            ->whereNotNull('id_dudi')
            ->distinct('id_dudi')
            ->count('id_dudi');

        return view("pembimbing.profile.index", compact("user", "jumlahSiswa", "jumlahDudi", "siswa"));
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
        $user = auth()->user();

        $request->validate([
            'photo_profile' => 'nullable|image|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo_profile')) {
            // hapus foto lama kalau ada
            if ($user->photo_profile) {
                Storage::disk('public')->delete($user->photo_profile);
            }

            $photoPath = $request->file('photo_profile')->store('profile_photos', 'public');
            $user->photo_profile = $photoPath;
        }

        $user->save();

        return redirect()->route('pembimbing.profile.index')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
