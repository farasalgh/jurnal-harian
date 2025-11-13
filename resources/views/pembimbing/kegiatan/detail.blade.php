@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Card -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1 me-4">
                        <div class="d-flex align-items-center mb-2">
                            <h4 class="mb-0 fw-bold text-dark">
                                {{ \Illuminate\Support\Str::words($kegiatan->keterangan_kegiatan, 10, '...') }}
                            </h4>
                            <span class="badge bg-gradient-dark ms-3">{{ $kegiatan->siswa->kelas->kelas ?? 'Kelas' }}</span>
                        </div>

                        <p class="text-muted mb-3">
                            {{ \Illuminate\Support\Str::words($kegiatan->keterangan_kegiatan, 25, '...') }}
                        </p>

                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-circle me-2 text-muted"></i>
                                <span class="fw-medium">{{ $kegiatan->siswa->user->name }}</span>
                            </div>
                            <div class="vr"></div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                <span
                                    class="text-muted">{{ \Carbon\Carbon::parse($kegiatan->created_at)->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="small fw-semibold mb-0">{{ $kegiatan->siswa->dudi->nama_dudi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Navigation -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-justified" id="customTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active py-3" id="keterangan-tab" data-bs-toggle="tab"
                            data-bs-target="#keterangan" type="button" role="tab">
                            <i class="fas fa-info-circle me-2"></i>Keterangan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-3" id="dokumentasi-tab" data-bs-toggle="tab"
                            data-bs-target="#dokumentasi" type="button" role="tab">
                            <i class="fas fa-images me-2"></i>Dokumentasi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link py-3" id="catatan-tab" data-bs-toggle="tab" data-bs-target="#catatan"
                            type="button" role="tab">
                            <i class="fas fa-sticky-note me-2"></i>Catatan Pembimbing
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="tab-content" id="customTabsContent">
            <!-- Keterangan Tab -->
            <div class="tab-pane fade show active" id="keterangan" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-info-circle text-primary me-2"></i>Detail Kegiatan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-semibold text-muted">Tempat Kegiatan:</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    {{ $kegiatan->siswa->dudi->nama_dudi }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-semibold text-muted">Guru Pembimbing:</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-tie text-primary me-2"></i>
                                    {{ $kegiatan->siswa->dudi->pembimbing }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-semibold text-muted">Keterangan:</div>
                            <div class="col-md-8">
                                <div class="bg-light p-3 rounded">
                                    <i class="fas fa-align-left text-primary me-2"></i>
                                    {{ $kegiatan->keterangan_kegiatan }}
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 fw-semibold text-muted">Waktu Kegiatan:</div>
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    {{ \Carbon\Carbon::parse($kegiatan->mulai_kegiatan)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($kegiatan->selesai_kegiatan)->format('H:i') }} WIB
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumentasi Tab -->
            <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-images text-primary me-2"></i>Dokumentasi Kegiatan
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($kegiatan->dokumentasi)
                            <div class="row g-3">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <a href="{{ asset('storage/' . $kegiatan->dokumentasi) }}" data-lightbox="dokumentasi"
                                            data-title="Dokumentasi Kegiatan">
                                            <img src="{{ asset('storage/' . $kegiatan->dokumentasi) }}" class="card-img-top"
                                                alt="Dokumentasi Kegiatan" style="height: 200px; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <p class="card-text small text-muted">Dokumentasi utama kegiatan</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more images here if available -->
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada dokumentasi untuk kegiatan ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Catatan Pembimbing Tab -->
            <div class="tab-pane fade" id="catatan" role="tabpanel">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-dark">
                            Catatan Pembimbing
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('pembimbing.kegiatan.update', $kegiatan->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="mb-4">
                                <textarea name="catatan_pembimbing" id="catatan_pembimbing" class="form-control" rows="6"
                                    placeholder="Tuliskan catatan untuk siswa...">{{ old('catatan_pembimbing', $kegiatan->catatan_pembimbing) }}</textarea>
                                @error('catatan_pembimbing')
                                    <div class="text-danger small mt-2">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    @if($kegiatan->updated_at)
                                        <i class="fas fa-clock me-1"></i>
                                        Terakhir diperbarui:
                                        {{ \Carbon\Carbon::parse($kegiatan->updated_at)->translatedFormat('d F Y, H:i') }}
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Catatan
                                </button>
                            </div>
                        </form>

                        <!-- Preview existing notes -->
                        @if($kegiatan->catatan_pembimbing && !old('catatan_pembimbing'))
                            <div class="mt-4 pt-4 border-top">
                                <h6 class="fw-semibold mb-3">
                                    <i class="fas fa-eye me-2 text-primary"></i>Pratinjau Catatan
                                </h6>
                                <div class="bg-light p-4 rounded">
                                    <p class="mb-0 text-dark">{{ $kegiatan->catatan_pembimbing }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .nav-tabs .nav-link:hover {
            color: #495057;
            border-bottom: 3px solid #dee2e6;
        }

        .card {
            border-radius: 12px;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .lightbox img {
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .lightbox:hover img {
            transform: scale(1.02);
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>

    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'imageFadeDuration': 300
        });

        // Auto-focus on textarea when catatan tab is shown
        document.getElementById('catatan-tab').addEventListener('shown.bs.tab', function () {
            document.getElementById('catatan_pembimbing').focus();
        });
    </script>
@endsection