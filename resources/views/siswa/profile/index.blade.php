@extends('layouts.app')

@section('title', 'Profile Siswa')

@section('page-title', 'Profile Siswa')

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
                        <img src="{{ optional($siswa)->photo_profile
        ? asset('storage/' . $siswa->photo_profile)
        : asset('static/profile.jpg') }}" alt="Foto Profil" class="w-100 h-100 shadow-sm" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name ?? 'Tidak Ada Data' }}
                        </h5>

                        <p class="mb-0 font-weight-normal text-sm">
                            {{ optional(optional($siswa)->kelas)->kelas ?? 'Tidak Ada data' }} -
                            {{ optional(optional($siswa)->jurusan)->jurusan ?? 'Tidak Ada data' }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                    role="tab" aria-selected="true">
                                    <i class="material-symbols-rounded text-lg position-relative">home</i>
                                    <span class="ms-1">App</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab"
                                    aria-selected="false">
                                    <i class="material-symbols-rounded text-lg position-relative">email</i>
                                    <span class="ms-1">Messages</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    role="tab" aria-selected="false">
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
                                            <strong>{{ optional(optional($siswa)->user)->name ?? 'Tidak Ada Data' }}</strong>
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
                                            {{ (optional($siswa)->tempat_lahir ?? '-') . ', ' .
        (optional($siswa)->tanggal_lahir
            ? \Carbon\Carbon::parse(optional($siswa)->tanggal_lahir)->format('d/m/Y')
            : '-'
        ) 
                                                }}
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
                                            {{ optional(optional($siswa)->user)->email ?? 'Tidak Ada Data' }}
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
                                                                    <img src="{{ $pembimbing->photo_profile
                                        ? asset('storage/' . $pembimbing->photo_profile)
                                        : asset('static/profile.jpg') }}" alt="Foto" class="border-radius-lg shadow">
                                                                </div>
                                                                <div class="d-flex align-items-start flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $pembimbing->name }}</h6>
                                                                    <p class="mb-0 text-xs">{{ $pembimbing->email }}</p>
                                                                </div>
                                                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                                                                    href="javascript:;">View</a>
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
                                            <img src="{{ asset('static/profile.jpg') }}" alt="kal"
                                                class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $dudi->nama_dudi }}</h6>
                                            <p class="mb-0 text-xs">{{ $dudi->kontak }}</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                                            href="javascript:;">View</a>
                                    @else
                                        <p>Belum ada dudi yang ditetapkan.</p>
                                    @endif
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    @if ($dudi)
                                        <div class="avatar me-3">
                                            <img src="{{ asset('static/profile.jpg') }}" alt="kal"
                                                class="border-radius-lg shadow">
                                        </div>
                                        <div class="d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $dudi->user->name }}</h6>
                                            <p class="mb-0 text-xs">{{ $dudi->kontak }}</p>
                                        </div>
                                        <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto"
                                            href="javascript:;">View</a>
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
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('siswa.profile.update', optional($siswa)->id ?? 0) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileLabel">Edit Profil Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="profile-pic-wrapper">
                                        <img id="previewImage" src="{{ optional($siswa)->photo_profile
                                            ? asset('storage/' . $siswa->photo_profile)
                                            : asset('static/profile.jpg') }}" alt="Foto Profil" class="profile-pic">
                                        <button type="button" class="edit-btn bg-gradient-dark"
                                            onclick="document.getElementById('fotoInput').click()">Edit</button>
                                        <input type="file" id="fotoInput" name="photo_profile" class="hidden-input"
                                            accept="image/*" onchange="previewImage(event)">
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" value="{{ optional(optional($siswa)->user)->name ?? '' }}"
                                                class="form-control styled-input" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="gender" class="form-control styled-input">
                                                <option value="">-- Pilih Jenis kelamin --</option>
                                                <option value="Laki-laki" 
                                                    {{ optional($siswa)->gender == 'laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki
                                                </option>
                                                <option value="Laki-laki" 
                                                    {{ optional($siswa)->gender == 'laki-laki' ? 'selected' : '' }}>
                                                    Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" value="{{ optional($siswa)->tempat_lahir ?? '' }}"
                                                class="form-control styled-input" placeholder="Belum diisi">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" value="{{ optional($siswa)->tanggal_lahir ?? '' }}"
                                                class="form-control styled-input">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Golongan Darah</label>
                                            <input type="text" name="gol_darah" value="{{ optional($siswa)->gol_darah ?? '' }}"
                                                class="form-control styled-input" placeholder="Belum diisi">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No Telepon</label>
                                            <input type="text" name="nomor" value="{{ optional($siswa)->nomor ?? '' }}"
                                                class="form-control styled-input" placeholder="Belum diisi">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control styled-input" rows="2"
                                                placeholder="Belum diisi" value="{{ optional(optional($siswa)->user)->email ?? 'Tidak Ada Data' }}">
                                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat" class="form-control styled-input" rows="2"
                                                placeholder="Belum diisi">{{ $siswa->alamat ?? '-' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
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
                            @if ($kegiatan->isNotEmpty())
                                @foreach($kegiatan->sortByDesc('created_at')->take(4) as $keg)
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        <div class="card card-blog card-plain">
                                            <div class="card-header p-0 m-2 overflow-hidden"
                                                style="height: 200px; border-radius: 1rem;">
                                                <a class="d-block shadow-xl border-radius-xl h-100 w-100">
                                                    @if ($keg->dokumentasi)
                                                        <img src="{{ asset('storage/' . $keg->dokumentasi) }}" alt=""
                                                            class="w-100 h-100 object-cover rounded-lg shadow">
                                                    @else
                                                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow"
                                                            class="w-100 h-100 object-cover rounded-lg shadow">
                                                    @endif
                                                </a>
                                            </div>

                                            <div class="card-body p-3">
                                                <p class="mb-0 text-sm">Project #{{ $loop->iteration }}</p>
                                                <a href="javascript:;">
                                                    <h5>
                                                        {{ \Illuminate\Support\Str::words($keg->keterangan_kegiatan, 4, '...') }}
                                                    </h5>
                                                </a>
                                                <p class="mb-4 text-sm">
                                                    {{ $keg->keterangan_kegiatan }}
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="{{ route('siswa.kegiatan.show', $keg->id) }} type=" button"
                                                        class="btn btn-outline-primary btn-sm mb-0">View
                                                        Project</a>
                                                    <div class="avatar-group mt-2">
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Elena Morison">
                                                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                                                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nick Daniel">
                                                            <img alt="Image placeholder" src="../assets/img/team-3.jpg">
                                                        </a>
                                                        <a href="javascript:;" class="avatar avatar-xs rounded-circle"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Peterson">
                                                            <img alt="Image placeholder" src="../assets/img/team-4.jpg">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex justify-content-center">
                                    <p>Tidak ada kegiatan baru-baru ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <style>
        .styled-input {
            border: 1.5px solid #bbb;
            border-radius: 8px;
            padding: 10px 12px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .styled-input:focus {
            border-color: #000;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
            outline: none;
        }

        label {
            margin-bottom: 6px;
        }

        .profile-pic-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ddd;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .hidden-input {
            display: none;
        }

        .edit-btn {
            position: absolute;
            bottom: 5px;
            right: 150px;
            background-color: #000;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .edit-btn:hover {
            background-color: #0b5ed7;
        }
    </style>
@endsection