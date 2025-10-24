@extends('layouts.app')

@section('content')
<form action="{{ route('admin.kelas.update', $kelas->id) }}" method="post" role="form" class="text-start">
    @csrf @method('PUT')
    <div class="input-group input-group-outline">
        <label class="form-label">Nama Kelas</label>
        <input type="text" name="kelas" value="{{ $kelas->kelas }}" class="form-control">
    </div>
    @error('kelas')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <div class="d-flex gap-3 justfiy-content-start">
        <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
        <a href="{{ route('admin.kelas.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
    </div>
</form>
@endsection