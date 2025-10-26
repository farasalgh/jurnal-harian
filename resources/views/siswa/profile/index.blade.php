@extends('layouts.app')

@section('title', 'Profile Siswa')

@section('page-title', 'Profile Siswa')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-2 mx-md-2 mt-n6">
        <div class="row gx-4 mb-2">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ $siswa->user->name }}
                    </h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ $siswa->kelas->kelas }} - {{ $siswa->jurusan->jurusan }}
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                <div class="nav-wrapper position-relative end-0">
                    <ul class="nav nav-pills nav-fill p-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                                <i class="material-symbols-rounded text-lg position-relative">home</i>
                                <span class="ms-1">App</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                <i class="material-symbols-rounded text-lg position-relative">email</i>
                                <span class="ms-1">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="modal" data-bs-target="#editProfileModal" role="tab" aria-selected="false">
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
                                    <label class="form-label text-sm">NIS</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        <strong>{{ $siswa->nis ?? '-' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Nama Lengkap</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        <strong>{{ $siswa->user->name }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Jenis Kelamin</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        {{ $siswa->gender ?? '-' }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Tempat, Tanggal Lahir</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        {{ ($siswa->tempat_lahir ?? '-') . ', ' . ($siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y') : '-') }}
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
                        <h6 class="mb-0">Academic & Contact</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label text-sm">Kelas</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        <strong>{{ $siswa->kelas->kelas ?? '-' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Jurusan</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        <strong>{{ $siswa->jurusan->jurusan ?? '-' }}</strong>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Email</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        {{ $siswa->user->email }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label text-sm">Alamat</label>
                                    <div class="form-control-plaintext border-bottom pb-2 mb-3">
                                        {{ $siswa->alamat ?? '-' }}
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
                        <h6 class="mb-0">Pembimbing</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                @if ($pembimbing)
                                <div class="avatar me-3">
                                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $pembimbing->name }}</h6>
                                    <p class="mb-0 text-xs">{{ $pembimbing->email }}</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">View</a>
                                @else
                                <p>Belum ada pembimbing yang ditetapkan.</p>
                                @endif
                            </li>
                        </ul>
                        <div class="mt-2">
                            <h6 class="mb-0">Dunia Kerja Dan Pembimbing Dunia Kerja</h6>
                        </div>
                        <ul class="list-group mt-3">
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                @if ($dudi)
                                <div class="avatar me-3">
                                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $dudi->nama_dudi }}</h6>
                                    <p class="mb-0 text-xs">{{ $dudi->kontak }}</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">View</a>
                                @else
                                <p>Belum ada dudi yang ditetapkan.</p>
                                @endif
                            </li>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                @if ($dudi)
                                <div class="avatar me-3">
                                    <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $dudi->pembimbing }}</h6>
                                    <p class="mb-0 text-xs">{{ $dudi->kontak }}</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">View</a>
                                @else
                                <p>Belum ada pembimbing dudi yang ditetapkan.</p>
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal Edit Profile -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg rounded-3">
                    <div class="modal-header bg-gradient-dark text-white">
                        <h5 class="modal-title text-white" id="editProfileModalLabel">Edit Profil Siswa</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('siswa.profile.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="name" class="form-control" value="{{ $siswa->user->name }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $siswa->user->email }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">NIS</label>
                                        <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <select name="id_kelas" class="form-control" required>
                                            @foreach($kelas as $k)
                                            <option value="{{ $k->id }}" {{ $siswa->id_kelas == $k->id ? 'selected' : '' }}>
                                                {{ $k->kelas }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <select name="id_jurusan" class="form-control" required>
                                            @foreach($jurusan as $j)
                                            <option value="{{ $j->id }}" {{ $siswa->id_jurusan == $j->id ? 'selected' : '' }}>
                                                {{ $j->jurusan }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $siswa->tempat_lahir ?? '' }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3 {{ $siswa->tanggal_lahir ? 'is-filled' : '' }}">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control"
                                            value="{{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d') : '' }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <select name="gender" class="form-control" required>
                                            <option value="laki-laki" {{ $siswa->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="perempuan" {{ $siswa->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Golongan Darah</label>
                                        <input type="text" name="gol_darah" class="form-control" value="{{ $siswa->gol_darah }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input type="text" name="nomor" class="form-control" value="{{ $siswa->nomor }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group input-group-outline my-3">
                                        <textarea name="alamat" class="form-control" placeholder="alamat" rows="3">{{ $siswa->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="mb-5 ps-3">
                        <h6 class="mb-1">Kegiatan</h6>
                        <p class="text-sm">Kegiatan PKL baru-baru ini..</p>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 m-2">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">Project #2</p>
                                    <a href="javascript:;">
                                        <h5>
                                            Modern
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        As Uber works through a huge amount of internal management turmoil.
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                                <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 m-2">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">Project #1</p>
                                    <a href="javascript:;">
                                        <h5>
                                            Scandinavian
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        Music is something that every person has his or her own specific opinion about.
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                                <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 m-2">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">Project #3</p>
                                    <a href="javascript:;">
                                        <h5>
                                            Minimalist
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        Different people have different taste, and various types of music. Music is life.
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                                <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                            <div class="card card-blog card-plain">
                                <div class="card-header p-0 m-2">
                                    <a class="d-block shadow-xl border-radius-xl">
                                        <img src="https://images.unsplash.com/photo-1606744824163-985d376605aa?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    <p class="mb-0 text-sm">Project #4</p>
                                    <a href="javascript:;">
                                        <h5>
                                            Gothic
                                        </h5>
                                    </a>
                                    <p class="mb-4 text-sm">
                                        Why would anyone pick blue over pink? Pink is obviously a better color.
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">View Project</button>
                                        <div class="avatar-group mt-2">
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                            </a>
                                            <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                                                <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection