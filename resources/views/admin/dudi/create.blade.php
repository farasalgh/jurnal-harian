@extends('layouts.app')

@section('content')
<div class="card-header p-4 rounded bg-gradient-dark">
    <h3 class="text-light fw-bold">Tambah Dudi</h3>
</div>
<div class="p-3 card-body">
    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="{{ route('admin.dudi.store') }}" method="post" role="form" class="text-start">
        @csrf
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nama Dudi</label>
            <input type="text" name="nama_dudi" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Jenis Dudi</label>
            <input type="text" name="jenis_dudi" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Pimpinan</label>
            <input type="text" name="pimpinan" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Pembimbing</label>
            <input type="text" name="pembimbing" class="form-control">
        </div>

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="{{ route('admin.dudi.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
</div>
@endsection