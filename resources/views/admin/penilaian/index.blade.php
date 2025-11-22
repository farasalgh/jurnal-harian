@extends('layouts.app')

@section('title', 'Dudi Tambah')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Penilaian table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.penilaian.create') }}" class="btn btn-primary mb-3">Tambah Aspek Pinilaian</a>

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        </div>
        <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Kreteria</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aspek Penilaian</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian as $pp)
                        <tr>
                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center text-sm">{{ $pp->kriteria }}</td>
                            <td class="align-middle text-center text-sm">{{ $pp->aspek_penilaian }}</td>
                            <td class="align-middle text-center text-sm">{{ $pp->created_at->format('d-m-Y H:i') }}</td>
                            <td class="align-middle text-center">
                                <a style="position: relative; top:7px;" href="{{ route('admin.dudi.edit', $pp->id) }}" class="btn btn-warning" data-toggle="tooltip" data-original-title="Edit user">
                                    Edit
                                </a>
                                <form action="{{ route('admin.penilaian.destroy', $pp->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button style="position: relative; top:7px;" class="btn btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</button>
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