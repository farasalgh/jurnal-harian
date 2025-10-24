@extends('layouts.app')

@section('title', 'Dudi Tambah')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Dudi table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.dudi.create') }}" class="btn btn-primary mb-3">Tambah Dudi</a>

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
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Jenis Dudi</th>
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                            <th class="text-uppercase text-center javascripttext-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dudi as $dd)
                        <tr>
                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center text-sm">{{ $dd->nama_dudi }}</td>
                            <td class="align-middle text-center text-sm">{{ $dd->jenis_dudi }}</td>
                            <td class="align-middle text-center text-sm">{{ $dd->alamat }}</td>
                            <td class="align-middle text-center text-sm">{{ $dd->created_at->format('d-m-Y H:i') }}</td>
                            <td class="align-middle text-center">
                                <a style="position: relative; top:7px;" href="{{ route('admin.dudi.show', $dd->id) }}" class="btn bg-gradient-dark" data-toggle="tooltip" data-original-title="Edit user">
                                    Detailed
                                </a>
                                <a style="position: relative; top:7px;" href="{{ route('admin.dudi.edit', $dd->id) }}" class="btn btn-warning" data-toggle="tooltip" data-original-title="Edit user">
                                    Edit
                                </a>
                                <form action="{{ route('admin.dudi.destroy', $dd->id) }}" method="POST" class="d-inline">
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