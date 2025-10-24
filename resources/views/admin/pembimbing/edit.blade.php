@extends('layouts.app')

@section('content')
<div class="card-header p-4 rounded bg-gradient-dark">
    <h3 class="text-light fw-bold">Tambah Pembimbinb</h3>
</div>
<div class="p-3 card-body">

    @if ($errors->any())
    <div class="alert alert-danger small">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="{{ route('admin.pembimbing.update', $pembimbing->id) }}" method="post" role="form" class="text-start">
        @csrf @method('PUT')
        <div class="input-group input-group-outline my-3">
            <label class="form-label">Nama Pembimbing</label>
            <input type="text" name="name" value="{{ $pembimbing->name }}" class="form-control">
            
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Email Pembimbing</label>
            <input type="email" name="email" value="{{ $pembimbing->email }}" class="form-control">
        </div>

        <div class="input-group input-group-outline my-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="d-flex gap-3 justfiy-content-start">
            <button type="submit" class="btn bg-gradient-dark my-4 mb-2">Tambah Data</button>
            <a href="{{ route('admin.pembimbing.index') }}" class="btn bg-gradient-primary my-4 mb-2 ">Kembali</a>
        </div>
    </form>
</div>
@endsection