@extends('layouts.app')

@section('content')
<div class="card-header p-4 rounded bg-gradient-dark">
    <h3 class="text-light fw-bold">Tambah Siswa</h3>
</div>
<div class="p-3 card-body">

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="{{ route('admin.siswa.store') }}" method="post" role="form" class="text-start">
        @csrf
        <div class="input-group input-group-outline my-3">
            <select name="id_kelas" class="form-control" aria-label="Default select example">
                <option selected>Pilih Kelas</option>
                @foreach ($kelas as $kls)
                <option name="id_kelas" value="{{ $kls->id }}">{{ $kls->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-outline mb-3">
            <select name="id_jurusan" class="form-control form-select" aria-label="Default select example">
                <option class="form-label" selected>Pilih Jurusan</option>
                @foreach ($jurusan as $jrs)
                <option name="id_jurusan" value="{{ $jrs->id }}">{{ $jrs->jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nis</label>
            <input type="text" name="nis" class="form-control">
        </div>

        <div class="input-group input-group-outline mb-3">
            <select name="id_dudi" class="form-control form-select" aria-label="Default select example">
                <option class="form-label" selected>Pilih Dunia Kerja</option>
                @foreach ($dudi as $d)
                <option name="id_pembimbing" value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline mb-3">
            <select name="id_pembimbing" class="form-control form-select" aria-label="Default select example">
                <option name="id_pembimbing" class="form-label" selected>Pilih Pembimbing</option>
                @foreach ($pembimbing as $pb)
                <option name="id_pembimbing" value="{{ $pb->id }}">{{ $pb->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
</div>
@endsection