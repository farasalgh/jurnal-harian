@extends('layouts.app')

@section('content')
<div class="card-header p-4 rounded bg-gradient-dark">
    <h3 class="text-light fw-bold">Tambah Aspek Penilaian</h3>
</div>
<div class="p-3 card-body">

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="{{ route('admin.penilaian.store') }}" method="post" role="form" class="text-start">
        @csrf
        <div class="input-group input-group-outline my-3">
            <select name="kriteria" id="" class="form-select form-control">
                <option value="Soft Skill" class="form-option" id="">Soft Skill</option>
            </select>
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Aspek Penilaian</label>
            <input type="text" name="aspek_penilaian" class="form-control">
        </div>

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="{{ route('admin.penilaian.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
</div>
@endsection