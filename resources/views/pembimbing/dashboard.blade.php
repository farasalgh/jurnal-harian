@extends('layouts.app')

@section('title', 'Dashboard Pembimbing')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <h3 class="mb-0 h4 fw-bold">@yield('title', 'dashboard')</h3>
        <p class="mb-4 text-muted">
          Check the sales, value and bounce rate by country.
        </p>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header p-3 pt-2 bg-transparent">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-sm mb-1 text-capitalize text-muted">Total absen siswa</p>
                <h4 class="mb-0 fw-bold">{{ $absen }}</h4>
              </div>
              <div class="icon icon-md icon-shape bg-dark shadow-dark text-center rounded-3">
                <i class="material-symbols-rounded opacity-10 text-white">checkbook</i>
              </div>
            </div>
          </div>
          <hr class="horizontal my-0">
          <div class="card-footer p-2 pt-0 bg-transparent">
            <p class="mb-0 text-sm"><span class="text-success fw-bold">+55% </span>than last week</p>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header p-3 pt-2 bg-transparent">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <p class="text-sm mb-1 text-capitalize text-muted">Total Siswa dibimbing</p>
                <h4 class="mb-0 fw-bold">{{ $siswa }}</h4>
              </div>
              <div class="icon icon-md icon-shape bg-dark shadow-dark text-center rounded-3">
                <i class="material-symbols-rounded opacity-10 text-white">person_check</i>
              </div>
            </div>
          </div>
          <hr class="horizontal my-0">
          <div class="card-footer p-2 pt-0 bg-transparent">
            <p class="mb-0 text-sm"><span class="text-success fw-bold">+3% </span>than last month</p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-3">
          <div class="card-header bg-transparent py-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h5 class="mb-0 fw-bold">Kegiatan Terbaru Siswa</h5>
                <p class="text-muted mb-0 small">Lihat aktivitas terbaru dari siswa bimbingan Anda</p>
              </div>
              <div class="d-flex align-items-center gap-2">
                <a href="{{ route('pembimbing.kegiatan.index') }}" class="btn btn-sm btn-outline-dark">Lihat Semua</a>
                <div class="carousel-controls">
                  <button class="btn btn-lg btn-light carousel-prev" type="button">
                    <i class="material-symbols-rounded">chevron_left</i>
                  </button>
                  <button class="btn btn-lg btn-light carousel-next" type="button">
                    <i class="material-symbols-rounded">chevron_right</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if($kegiatanTerbaru->count() > 0)
              <div class="activity-carousel">
                <div class="carousel-container">
                  <div class="carousel-track" id="carouselTrack">
                    @foreach($kegiatanTerbaru as $kegiatan)
                      <div class="carousel-slide">
                        <div class="activity-card">
                          <div class="card-image">
                            <img
                              src="{{ $kegiatan->dokumentasi ? asset('storage/' . $kegiatan->dokumentasi) : asset('static/landscape.jpg') }}"
                              alt="gambar kegiatan" class="card-img">
                            <div class="image-overlay"></div>
                            <span class="time-badge">{{ $kegiatan->created_at->diffForHumans() }}</span>
                          </div>

                          <div class="card-content">
                            <h6 class="card-title">
                              {{ Str::limit($kegiatan->keterangan_kegiatan, 50) }}
                            </h6>
                            <p class="card-description">
                              {{ Str::limit($kegiatan->keterangan_kegiatan, 100) }}
                            </p>

                            <div class="card-footer">
                              <div class="user-info">
                                <div class="avatar">
                                  <img
                                    src="{{ $kegiatan->siswa->photo_profile ? asset('storage/' . $kegiatan->siswa->photo_profile) : asset('static/profile.jpg') }}"
                                    alt="user" class="avatar-img">
                                </div>
                                <div class="user-details">
                                  <p class="user-name">{{ $kegiatan->siswa->user->name ?? 'Nama Siswa' }}</p>
                                  <span class="user-school">{{ $kegiatan->siswa->dudi->nama_dudi ?? 'Sekolah' }}</span>
                                </div>
                              </div>
                              <button class="btn-action">
                                <i class="material-symbols-rounded">arrow_outward</i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators" id="carouselIndicators">
                  @for($i = 0; $i < ceil($kegiatanTerbaru->count() / 3); $i++)
                    <button class="indicator {{ $i === 0 ? 'active' : '' }}" data-slide="{{ $i }}"></button>
                  @endfor
                </div>
              </div>
            @else
              <div class="text-center py-5">
                <div class="empty-state">
                  <i class="material-symbols-rounded text-muted mb-3" style="font-size: 64px;">photo_library</i>
                  <h6 class="text-muted mb-2">Belum ada kegiatan terbaru</h6>
                  <p class="text-muted small">Siswa bimbingan Anda belum mengunggah kegiatan baru.</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .activity-carousel {
      position: relative;
      padding: 0 20px;
    }

    .carousel-container {
      overflow: hidden;
      border-radius: 16px;
    }

    .carousel-track {
      display: flex;
      transition: transform 0.5s ease-in-out;
      gap: 20px;
    }

    .carousel-slide {
      flex: 0 0 calc(33.333% - 14px);
      min-width: calc(33.333% - 14px);
    }

    .activity-card {
      background: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border: 1px solid #f0f0f0;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .activity-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-image {
      position: relative;
      height: 200px;
      overflow: hidden;
    }

    .card-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .activity-card:hover .card-img {
      transform: scale(1.05);
    }

    .image-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.3));
    }

    .time-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      background: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 4px 8px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 500;
      backdrop-filter: blur(10px);
    }

    .card-content {
      padding: 20px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .card-title {
      font-weight: 700;
      font-size: 15px;
      line-height: 1.4;
      color: #1a1a1a;
      margin-bottom: 8px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .card-description {
      font-size: 13px;
      line-height: 1.5;
      color: #666;
      margin-bottom: 16px;
      flex-grow: 1;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .card-footer {
      display: flex;
      align-items: center;
      justify-content: between;
      gap: 12px;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-grow: 1;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      overflow: hidden;
      flex-shrink: 0;
    }

    .avatar-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .user-details {
      flex-grow: 1;
      min-width: 0;
    }

    .user-name {
      font-size: 13px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .user-school {
      font-size: 11px;
      color: #888;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .btn-action {
      width: 32px;
      height: 32px;
      border: none;
      background: #f8f9fa;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #666;
      transition: all 0.2s ease;
      flex-shrink: 0;
    }

    .btn-action:hover {
      background: #000;
      color: white;
    }

    .carousel-controls {
      display: flex;
      gap: 8px;
    }

    .carousel-controls .btn {
      width: 36px;
      height: 36px;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
    }

    .carousel-indicators {
      display: flex;
      justify-content: center;
      gap: 8px;
      margin-top: 24px;
    }

    .indicator {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      border: none;
      background: #e0e0e0;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .indicator.active {
      background: #000;
      transform: scale(1.2);
    }

    .empty-state {
      padding: 40px 20px;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
      .carousel-slide {
        flex: 0 0 calc(50% - 10px);
        min-width: calc(50% - 10px);
      }
    }

    @media (max-width: 768px) {
      .carousel-slide {
        flex: 0 0 calc(100% - 10px);
        min-width: calc(100% - 10px);
      }

      .activity-carousel {
        padding: 0 10px;
      }
    }
  </style>
@endsection


@push('scripts')
  <script>
    const track = document.getElementById('carouselTrack');
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    const prevBtn = document.querySelector('.carousel-prev');
    const nextBtn = document.querySelector('.carousel-next');

    let currentSlide = 0;
    const slidesPerView = window.innerWidth < 768 ? 1 : window.innerWidth < 992 ? 2 : 3;
    const totalSlides = slides.length;
    const totalGroups = Math.ceil(totalSlides / slidesPerView);

    function updateCarousel() {
      const slideWidth = slides[0].offsetWidth + 20; // including gap
      track.style.transform = `translateX(-${currentSlide * slideWidth * slidesPerView}px)`;

      // Update indicators
      indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlide);
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % totalGroups;
      updateCarousel();
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + totalGroups) % totalGroups;
      updateCarousel();
    }

    // Event listeners
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        currentSlide = index;
        updateCarousel();
      });
    });

    // Handle window resize
    window.addEventListener('resize', function () {
      const newSlidesPerView = window.innerWidth < 768 ? 1 : window.innerWidth < 992 ? 2 : 3;
      if (newSlidesPerView !== slidesPerView) {
        currentSlide = 0;
        updateCarousel();
      }
    });

    // Initialize carousel
    updateCarousel();
  </script>
@endpush