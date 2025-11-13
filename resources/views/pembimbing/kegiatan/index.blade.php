@extends('layouts.app')

@section('title', 'Daftar Kegiatan Siswa')

@section('page-title', 'Daftar Kegiatan Siswa')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="material-symbols-rounded text-dark me-2">supervisor_account</i>
                    Daftar Kegiatan Siswa Bimbingan
                </h4>
            </div>

            {{-- Three Column Layout --}}
            @php
                // Bagi kegiatan jadi 3 kolom (bulan per kolom)
                $bulanKeys = $kegiatan->keys();
                $chunks = $bulanKeys->chunk(ceil($bulanKeys->count() / 3));
            @endphp

            <div class="row">
                @foreach ($chunks as $chunkIndex => $bulanChunk)
                    <div class="col-md-4">
                        <div
                            class="column-header bg-light rounded-3 p-3 mb-3 d-flex align-items-center justify-content-between shadow-sm border-start border-4 border-dark">
                            <div class="d-flex align-items-center">
                                <!-- Titik dekoratif dalam bentuk persegi (2x2) -->
                                <div class="d-grid me-3" style="grid-template-columns: repeat(2, 6px); grid-gap: 3px;">
                                    <span class="bg-primary rounded-circle" style="width:6px; height:6px;"></span>
                                    <span class="bg-secondary rounded-circle" style="width:6px; height:6px;"></span>
                                    <span class="bg-success rounded-circle" style="width:6px; height:6px;"></span>
                                    <span class="bg-warning rounded-circle" style="width:6px; height:6px;"></span>
                                </div>

                                <!-- Judul bulan dengan ikon -->
                                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center">
                                    <i class="material-symbols-rounded text-dark me-1"
                                        style="font-size: 18px;">calendar_month</i>
                                    Bulan {{ $chunkIndex + 1 }}
                                </h6>
                            </div>

                            <!-- Badge jumlah kegiatan -->
                            <span class="badge bg-gradient bg-dark d-flex align-items-center px-2 py-1">
                                <i class="material-symbols-rounded me-1" style="font-size: 14px;">event</i>
                                {{ collect($bulanChunk)->sum(fn($b) => $kegiatan[$b]->flatten(1)->count()) }}
                            </span>
                        </div>

                        {{-- Loop per bulan --}}
                        @foreach ($bulanChunk as $bulan)
                            <h6 class="fw-bold text-dark mt-3">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}
                            </h6>

                            {{-- Loop per minggu --}}
                            @foreach ($kegiatan[$bulan] as $minggu => $daftarKegiatan)
                                <p class="text-muted small mb-2">Minggu ke-{{ $minggu }}</p>

                                @forelse ($daftarKegiatan as $ktn)
                                    <div class="card shadow-sm border-0 rounded-3 mb-3 hover-lift">
                                        <div class="card-body p-3">
                                            {{-- Header kegiatan --}}
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div class="flex-grow-1 me-2">
                                                    <h6 class="text-dark fw-bold mb-1 text-truncate">
                                                        {{ $ktn->keterangan_kegiatan }}
                                                    </h6>
                                                    <div class="d-flex align-items-center text-muted small mb-1">
                                                        <i class="material-symbols-rounded me-1" style="font-size: 14px;">calendar_today</i>
                                                        <span>{{ \Carbon\Carbon::parse($ktn->tanggal)->translatedFormat('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Waktu kegiatan --}}
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="material-symbols-rounded text-primary me-1" style="font-size: 14px;">schedule</i>
                                                <span class="text-dark small">
                                                    {{ \Carbon\Carbon::parse($ktn->mulai_kegiatan)->format('H:i') }}
                                                    –
                                                    {{ \Carbon\Carbon::parse($ktn->selesai_kegiatan)->format('H:i') }}
                                                </span>
                                            </div>

                                            {{-- Catatan pembimbing --}}
                                            @if ($ktn->catatan_pembimbing)
                                                <div class="bg-light rounded-2 p-2 mb-2">
                                                    <p class="text-xs text-muted mb-1">
                                                        <i class="material-symbols-rounded text-secondary me-1"
                                                            style="font-size: 14px;">comment</i>
                                                        <strong>Catatan Pembimbing:</strong>
                                                    </p>
                                                    <p class="text-xs text-dark mb-0">
                                                        {{ Str::limit($ktn->catatan_pembimbing, 60, '...') }}
                                                    </p>
                                                </div>
                                            @endif

                                            {{-- Footer info --}}
                                            <div class="d-flex justify-content-between align-items-center text-xs text-muted mb-2">
                                                <span>
                                                    <i class="material-symbols-rounded me-1" style="font-size: 14px;">person</i>
                                                    {{ $ktn->siswa->user->name ?? 'Siswa' }}
                                                </span>
                                                <span>{{ \Carbon\Carbon::parse($ktn->created_at)->format('d/m/y') }}</span>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                                <a href="{{ route('pembimbing.kegiatan.show', $ktn->id) }}"
                                                    class="text-primary text-xs text-decoration-none d-flex align-items-center">
                                                    <i class="material-symbols-rounded me-1 d-flex align-items-center"
                                                        style="font-size: 16px;">visibility</i>
                                                    <span class="align-middle">Lihat Detail</span>
                                                </a>

                                                {{-- Pembimbing tidak edit/hapus --}}
                                                <div class="text-muted small d-flex align-items-center">
                                                    <i class="material-symbols-rounded me-1" style="font-size: 14px;">lock</i>
                                                    Hanya lihat
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted small">Tidak ada kegiatan minggu ini</p>
                                @endforelse
                            @endforeach
                        @endforeach
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <style>
        .column-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 4px solid #dee2e6;
        }

        .column-header:first-child {
            border-left-color: #6c757d;
        }

        .column-header:nth-child(2) {
            border-left-color: #0d6efd;
        }

        .column-header:last-child {
            border-left-color: #198754;
        }

        .hover-lift {
            transition: all 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            line-height: 1;
            border-radius: 0.2rem;
        }

        .text-xs {
            font-size: 0.75rem;
        }

        .material-symbols-rounded {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
@endsection