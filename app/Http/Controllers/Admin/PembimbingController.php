<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PembimbingController extends Controller
{
    //
    public function index()
    {
        $pembimbing = User::where('role', 'pembimbing')->get();
        return view('admin.pembimbing.index', compact('pembimbing'));
    }

    public function create()
    {
        return view('admin.pembimbing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembimbing',
        ]);


        return redirect()->route('admin.pembimbing.index')->with('success', 'Berhasil menambahkan pembimbing');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.pembimbing.index')->with('success', 'Berhasil menghapus data ini');
    }
}
