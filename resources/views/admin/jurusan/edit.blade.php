@extends('layouts.app')

@section('content')
<form action="{{ route('admin.jurusan.update', $jurusan->id) }}" method="post" role="form" class="text-start">
    @csrf  @method('PUT')
    <div class="input-group input-group-outline my-3">
        <label class="form-label">Nama Kelas</label>
        <input type="text" name="jurusan" value="{{ $jurusan->jurusan }}" class="form-control">
    </div>
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Update</button>
    </div>
 </form>
@endsection