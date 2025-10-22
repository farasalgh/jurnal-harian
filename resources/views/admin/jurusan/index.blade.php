@extends('layouts.app')

@section('title', 'Jurusan Tambah')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Jurusan table</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary mb-3">Tambah jurusan</a>

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
                            <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created-at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusan as $jrs)
                        <tr>
                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center text-sm">{{ $jrs->jurusan }}</td>
                            <td class="align-middle text-center text-sm">{{ $jrs->created_at->format('d-m-Y H:i') }}</td>
                            <td class="d-flex justify-content-center gap-3">
                                <a style="position: relative; top:7px;" href="{{ route('admin.jurusan.edit', $jrs->id) }}" class="btn btn-warning" data-toggle="tooltip" data-original-title="Edit user">
                                    Edit
                                </a>
                                <form action="{{ route('admin.jurusan.destroy', $jrs->id) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button style="position: relative; top:7px;" type="submit" class="btn btn-danger">Delete</button>
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