@extends('layouts.app')

@section('page-title', 'Kegiatan Siswa')

@section('content')
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Kegiatan table</h6>
                </div>
            </div>
            <div class="m-3 mb-2">
                <a href="{{ route('siswa.kegiatan.create') }}" class="btn btn-primary mb-3">Masukkan kegiatan</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tanggal kegiatan</th>
                                <th
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    waktu kegiatan</th>
                                <th
                                    class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    dokumentasi </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    catatan pembimbing</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    keterangan kegiatan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $ktn)
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $sw->name }}</td>
                                    <td class="align-middle text-center text-left text-sm">{{ $sw->email }}</td>
                                    <td class="align-middle text-center text-left text-sm">
                                        {{ $sw->siswa->dudi->nama_dudi ?? '-' }}
                                    </td>
                                    <td class="align-middle text-center text-sm">{{ $sw->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="align-middle text-center">
                                        <a style="position: relative; top:7px;" href="{{ route('admin.siswa.edit', $sw->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form action="{{ route('admin.siswa.destroy', $sw->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button style="position: relative; top:7px;" class="btn btn-danger"
                                                onclick="return confirm('Hapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection