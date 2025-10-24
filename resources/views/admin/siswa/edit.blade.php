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
    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="post" role="form" class="text-start">
        @csrf @method('PUT')
        <div class="input-group input-group-outline my-3">
            <select name="id_kelas" class="form-control" aria-label="Default select example">
                <option value="">-- Pilih Kelas --</option>
                @foreach($kelas as $k)
                <option value="{{ $k->id }}" {{ (old('id_kelas', $siswaData->id_kelas ?? '') == $k->id) ? 'selected' : '' }}>
                    {{ $k->kelas }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="input-group input-group-outline mb-3">
            <select name="id_jurusan" class="form-control">
                <option value="">-- Pilih Jurusan --</option>
                @foreach($jurusan as $j)
                <option value="{{ $j->id }}" {{ (old('id_jurusan', $siswaData->id_jurusan ?? '') == $j->id) ? 'selected' : '' }}>
                    {{ $j->jurusan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nis</label>
            <input type="text" name="nis" value="{{ old('nis', $siswaData['nis']) }}" class="form-control">
        </div>

        <div class="input-group input-group-outline mb-3">
            <select name="id_dudi" class="form-control form-select" aria-label="Default select example">
                <option value="">-- Pilih Dudi --</option>
                @foreach($dudi as $d)
                <option value="{{ $d->id }}"
                    {{ (old('id_dudi') ?? ($siswaData->dudi->id ?? '')) == $d->id ? 'selected' : '' }}>
                    {{ $d->nama_dudi }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline mb-3">
            <select name="id_pembimbing" class="form-control form-select" aria-label="Default select example">
                @foreach ($pembimbing as $p)
                <option value="{{ $p->id }}"
                    {{ old('id_pembimbing', $siswaData->id_pembimbing ?? '') == $p->id ? 'selected' : '' }}>
                    {{ $p->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nama Siswa</label>
            <input type="text" name="name" value="{{ old('name', $userData['name']) }}" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $userData['email']) }}" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="{{ route('admin.siswa.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
</div>
@endsection