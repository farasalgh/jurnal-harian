@extends('layouts.app')

@section('content')
<form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="post" role="form" class="text-start">
    @csrf @method('PUT')
    <div class="input-group input-group-outline my-3">
        <label class="form-label">Nama Kelas</label>
        <input type="text" name="jurusan" value="{{ $jurusan->jurusan }}" class="form-control">
    </div>
    <div class="d-flex gap-3 justfiy-content-start">
        <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
        <a href="{{ route('admin.jurusan.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
    </div>
</form>
@endsection