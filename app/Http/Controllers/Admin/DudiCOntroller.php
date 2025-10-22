<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $dudi = Dudi::all();
        return view("admin.dudi.index", compact("dudi"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.dudi.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "nama_dudi"=> "required",
            "jenis_dudi"=> "required",
            "alamat"=> "required",
            "kontak"=> "required",
            "pimpinan"=> "required",
            "pembimbing"=> "required",
        ]);

        Dudi::create($request->all());

        return redirect()->route("admin.dudi.index")->with("success","Berhasil menambahkan dudi");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $dudi = Dudi::find($id);
        return view("admin.dudi.detail", compact("dudi"));
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
    public function destroy(Dudi $dudi)
    {
        //
        $dudi->delete();
        return redirect()->route("admin.dudi.index")->with("success","data Dudi berhasil dihapus");
    }
}
