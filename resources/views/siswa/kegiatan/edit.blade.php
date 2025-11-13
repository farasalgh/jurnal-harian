@extends('layouts.app')

@section('content')
    <form action="{{ route('siswa.kegiatan.update', $kegiatan->id) }}" method="post" enctype="multipart/form-data" role="form" class="text-start">
        @csrf @method('PUT')
        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Keterangan Kegiatan</label>
            <input type="text" name="keterangan_kegiatan" value="{{ $kegiatan->keterangan_kegiatan }}" class="form-control">
        </div>
        @error('keterangan_kegiatan')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Keterangan Kegiatan</label>
            <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}" class="form-control">
        </div>
        @error('tanggal')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Keterangan Kegiatan</label>
            <input type="time" name="mulai_kegiatan" value="{{ $kegiatan->mulai_kegiatan }}" class="form-control">
        </div>
        @error('mulai_kegiatan')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="input-group input-group-outline mb-3">
            <label class="form-label">Keterangan Kegiatan</label>
            <input type="time" name="selesai_kegiatan" value="{{ $kegiatan->selesai_kegiatan }}" class="form-control">
        </div>
        @error('selesai_kegiatan')
            <div class="text-danger">{{ $message }}</div>
        @enderror


        <div class="input-group input-group-outline mb-3">
            <input type="file" name="dokumentasi" value="{{ $kegiatan->dokumentasi }}" class="form-control">
        </div>
        @error('dokumentasi')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="{{ route('siswa.kegiatan.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
@endsection