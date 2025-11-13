@extends('layouts.app')

@section('title', 'Profile user')

@section('page-title', 'Profile user')

@section('content')
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('{{ asset('static/landscape.jpg') }}');">
            <span class="mask  bg-gradient-dark  opacity-6"></span>
        </div>

        <div class="card card-body mx-2 mx-md-2 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar position-relative"
                        style="width: 85px; height: 85px; overflow: hidden; border-radius: 10px;">
                        <img src="{{ $user->photo_profile
        ? asset('storage/' . $user->photo_profile)
        : asset('static/profile.jpghpng') }}" alt="Foto Profil" class="w-100 h-100 shadow-sm"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <div class="mb-1 d-flex gap-4 text-sm">
                            <h5>{{ $user->name }}</h5>

                        </div>
                        <p class="mb-0 font-weight-normal text-sm text-secondary">
                            Bergabung sejak {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="modal"
                                    data-bs-target="#editProfileModal" role="tab" aria-selected="false">
                                    <i class="material-symbols-rounded text-lg position-relative">settings</i>
                                    <span class="ms-1">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Profile Details</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label text-sm">Nama</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                            <strong>{{ $user->name ?? '-' }}</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-sm">Email</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                            <strong>{{ $user->email }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Statistik Pembimbing</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label text-sm">Jumlah Murid yang di pimbing</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                            <strong>{{ $jumlahSiswa ?? '-' }} Siswa</strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label text-sm">Jumlah Dudi Siswa di bimbing</label>
                                        <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                            <strong>{{ $jumlahDudi ?? '-' }} Dunia Kerja</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Murid dibimbing</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @if ($siswa->isNotEmpty())
                                    @foreach ($siswa as $murid)
                                                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                                            <div class="avatar me-3">
                                                                <img src="{{ $murid->photo_profile
                                        ? asset('storage/' . $murid->photo_profile)
                                        : asset('static/profile.jpg') }}" alt="Foto" class="border-radius-lg shadow">
                                                            </div>
                                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">{{ $murid->user->name }}</h6>
                                                                <p class="mb-0 text-xs">{{ $murid->user->email }}</p>
                                                            </div>
                                                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                                                                href="javascript:;">View</a>
                                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item border-0 px-0 pt-0">
                                        <p>Belum ada pembimbing yang ditetapkan.</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Modal Edit Profile -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content shadow-lg rounded-3">
                        <div class="modal-header bg-gradient-dark text-white">
                            <h5 class="modal-title text-white" id="editProfileModalLabel">Edit Profil user</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('pembimbing.profile.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="modal-body px-4">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="input-group input-group-outline my-3">
                                            <input type="file" name="photo_profile" class="form-control">
                                        </div>
                                        <small class="text-muted mt-n3" style="display: block;">Kosongkan jika tidak ingin
                                            mengubah foto profil.</small>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                {{-- Tambahkan 'data-bs-dismiss' untuk fungsionalitas modal --}}
                                <button type="button" class="btn bg-gradient-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>




        </div>
    </div>
    </div>
    </div>
@endsection