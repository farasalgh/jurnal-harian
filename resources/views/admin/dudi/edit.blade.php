@extends('layouts.app')

@section('content')
<form action="{{ route('admin.dudi.update', $dudi->id) }}" method="post" role="form" class="text-start">
    @csrf @method('PUT')
    <div class="input-group input-group-outline my-3">
        <label class="form-label">Nama Kelas</label>
        <input type="text" name="nama_dudi" value="{{ $dudi->nama_dudi }}" class="form-control">
    </div>

    <div class="input-group input-group-outline my-3">
        <label class="form-label">Jenis Dunia kerja</label>
        <input type="text" name="jenis_dudi" value="{{ $dudi->jenis_dudi }}" class="form-control">
    </div>

    <div class="input-group input-group-outline my-3">
        <label class="form-label">alamat</label>
        <input type="text" name="alamat" value="{{ $dudi->alamat }}" class="form-control">
    </div>

    <div class="input-group input-group-outline my-3">
        <label class="form-label">Kontak</label>
        <input type="text" name="kontak" value="{{ $dudi->kontak }}" class="form-control">
    </div>

    <div class="input-group input-group-outline my-3">
        <label class="form-label">Direktur</label>
        <input type="text" name="pimpinan" value="{{ $dudi->pimpinan }}" class="form-control">
    </div>

    <div class="input-group input-group-outline my-3">
        <label class="form-label">Pembimbing</label>
        <input type="text" name="pembimbing" value="{{ $dudi->pembimbing }}" class="form-control">
    </div>
    <div class="d-flex gap-3 justfiy-content-start">
        <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
        <a href="{{ route('admin.dudi.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
    </div>
</form>
@endsection