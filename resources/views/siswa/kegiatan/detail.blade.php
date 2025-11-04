@extends('layouts.app')

@section('content')

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="mb-1">{{ \Illuminate\Support\Str::words($kegiatan->keterangan_kegiatan, 10, '...') }}</h4>
                    <p class="text-muted mb-2">
                        {{ \Illuminate\Support\Str::words($kegiatan->keterangan_kegiatan, 20, '...') }}
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-secondary">{{ $siswa->user->name }}</span>
                    </div>
                </div>

                <div class="text-end">
                    <!-- <img src="../assets/img/home-decor-1.jpg" class="rounded-circle" alt="Company Logo"> -->
                    <p class="small text-muted mb-0">{{ $siswa->dudi->nama_dudi }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between text-center">
                        <div class="flex-fill p-2 bg-success-subtle rounded">Meeting Scheduled</div>
                        <div class="flex-fill p-2 bg-warning-subtle rounded mx-2">Proposal Made (Sales)</div>
                        <div class="flex-fill p-2 bg-danger-subtle rounded">Account Closed (Sales)</div>
                        <div class="flex-fill p-2 bg-info-subtle rounded ms-2">Onboarding (CS)</div>
                    </div>
                </div>
            </div> -->

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-3" id="customTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active text-dark" id="customers-tab" data-bs-toggle="tab" data-bs-target="#customers"
                type="button" role="tab">Keterangan</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="accounts-tab" data-bs-toggle="tab" data-bs-target="#accounts" type="button"
                role="tab">Dokumentasi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-dark" id="angela-tab" data-bs-toggle="tab" data-bs-target="#angela" type="button"
                role="tab">Catatan Pembimbing</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link  text-dark" id="yellow-tab" data-bs-toggle="tab" data-bs-target="#yellow" type="button"
                role="tab">Yellow Accounts</button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="customTabsContent">
        <div class="tab-pane fade show active" id="customers" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">keterangan kegiatan</h6>

                     <div class="row mb-2">
                        <div class="col-md-4"><strong>Tempat kegiatan:</strong></div>
                        <div class="col-md-8">{{ $siswa->dudi->nama_dudi }}</div>
                    </div>

                     <div class="row mb-2">
                        <div class="col-md-4"><strong>Guru pembing kegiatan:</strong></div>
                        <div class="col-md-8">{{ $siswa->dudi->pembimbing }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Keterangan:</strong></div>
                        <div class="col-md-8">{{ $kegiatan->keterangan_kegiatan }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Jam mulai kegiatan:</strong></div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($kegiatan->mulai_kegiatan)->format('H:i') }} - WIB</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4"><strong>Jam selesai kegiatan:</strong></div>
                        <div class="col-md-8">{{ \Carbon\Carbon::parse($kegiatan->selesai_kegiatan)->format('H:i') }} - WIB</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="accounts" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h6 class="fw-bold mb-3">Dokumentasi kegiatan</h6>

                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="angela" role="tabpanel">
            <div class="alert alert-info">Angela’s Accounts content here.</div>
        </div>

        <div class="tab-pane fade" id="yellow" role="tabpanel">
            <div class="alert alert-info">Yellow Accounts content here.</div>
        </div>
    </div>
@endsection