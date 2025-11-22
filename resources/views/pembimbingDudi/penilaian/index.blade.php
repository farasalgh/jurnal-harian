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
            <div class="m-3">
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    User</th>
                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    Kelas</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Rata - Rata Nilai</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $pp)
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                    <td class="align-middle text-center text-sm">{{ $pp->user->name }}</td>
                                    <td class="align-middle text-center text-sm">{{ $pp->kelas->kelas }}</td>
                                    <td class="text-center">
                                        {{ $pp->penilaians->avg('rata_rata') ?? 'Belum ada nilai' }}
                                    </td>
                                    @php
                                        $penilaian = $pp->penilaians->first();
                                    @endphp
                                    <td class="align-middle text-center text-sm">
                                        <a href="{{ route('pembimbingDudi.penilaian.form', ['siswa_id' => $pp->id]) }}"
                                            class="btn btn-primary" style="position: relative; top:7px;">
                                            Beri Nilai
                                        </a>
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