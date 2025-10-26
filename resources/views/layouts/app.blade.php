<!DOCTYPE html>
<html lang="en">

<head>
  <!-- HEAD -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/assets/img/favicon.png">
  <title>@yield('title', 'Jurhar App')</title>

  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
  <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
</head>

<body class="g-sidenav-show bg-gray-100">

  <!-- =========================
       SIDEBAR
  ========================== -->
  <aside class="sidenav n avbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="/assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Jurnal Harian App</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          @if(auth()->user()->role === 'admin')
            <a class="nav-link text-dark {{ request()->routeIs('admin.dashboard') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('admin.dashboard') }}">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          @elseif(auth()->user()->role === 'pembimbing')
            <a class="nav-link text-dark{{ request()->routeIs('pembimbing.dashboard') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('pembimbing.dashboard') }}">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          @elseif(auth()->user()->role === 'siswa')
            <a class="nav-link text-dark{{ request()->routeIs('siswa.dashboard') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('siswa.dashboard') }}">
              <i class="material-symbols-rounded opacity-5">dashboard</i>
              <span class="nav-link-text ms-1">Dashboard</span>
            </a>
          @endif
        </li>
        <!-- ... menu lainnya ... -->
        @if (Auth::user() && Auth::user()->role === 'admin')
          <li class="nav-item mt-1">
            <!-- Accordion Header -->
            <a class="nav-link text-dark d-flex justify-content-between align-items-center" href="javascript:;"
              onclick="document.getElementById('kelolaUserMenu').classList.toggle('d-none')">
              <div class="d-flex align-items-center">
                <i class="material-symbols-rounded opacity-5">group</i>
                <span class="nav-link-text ms-1">Kelola User</span>
              </div>
              <i class="material-symbols-rounded opacity-5">expand_more</i>
            </a>

            <!-- Accordion Content -->
            <ul
              class="nav flex-column ms-3 mt-1 {{ request()->routeIs('admin.siswa.') || request()->routeIs('admin.pembimbings.') ? '' : 'd-none' }}"
              id="kelolaUserMenu">
              <li class="nav-item">
                <a href="{{ route('admin.siswa.index') }}"
                  class="nav-link text-dark {{ request()->routeIs('admin.siswa.index') ? 'active bg-gradient-dark text-white' : '' }}">
                  <i class="material-symbols-rounded opacity-5">person</i>
                  <span class="nav-link-text ms-1">Kelola Siswa</span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.pembimbing.index') }}"
                  class="nav-link text-dark {{ request()->routeIs('admin.pembimbing.index') ? 'active bg-gradient-dark text-white' : '' }}">
                  <i class="material-symbols-rounded opacity-5">person</i>
                  <span class="nav-link-text ms-1">Kelola Pembimbing</span>
                </a>
              </li>
            </ul>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'admin')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('admin.kelas.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('admin.kelas.index') }}">
              <i class="material-symbols-rounded opacity-5">co_present</i>
              <span class="nav-link-text ms-1">Kelola Kelas</span>
            </a>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'admin')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('admin.jurusan.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('admin.jurusan.index') }}">
              <i class="material-symbols-rounded opacity-5">category</i>
              <span class="nav-link-text ms-1">Kelola Jurusan</span>
            </a>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'admin')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('admin.dudi.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('admin.dudi.index') }}">
              <i class="material-symbols-rounded opacity-5">work</i>
              <span class="nav-link-text ms-1">Kelola Dudi</span>
            </a>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'siswa')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('siswa.profile.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('siswa.profile.index') }}">
              <i class="material-symbols-rounded opacity-5">account_box</i>
              <span class="nav-link-text ms-1">Kelola Profile</span>
            </a>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'siswa')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('siswa.kegiatan.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('siswa.kegiatan.index') }}">
              <i class="material-symbols-rounded opacity-5">search_activity</i>
              <span class="nav-link-text ms-1">Kelola Kegiatan</span>
            </a>
          </li>
        @endif

        @if (Auth::user() && Auth::user()->role === 'siswa')
          <li class="nav-item mt-1">
            <a class="nav-link text-dark{{ request()->routeIs('siswa.absen.index') ? 'active bg-gradient-dark text-white' : '' }}"
              href="{{ route('siswa.absen.index') }}">
              <i class="material-symbols-rounded opacity-5">calendar_check</i>
              <span class="nav-link-text ms-1">Kelola Absen</span>
            </a>
          </li>
        @endif

      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="btn bg-gradient-danger w-100 mt-4 text-white">
            <i class="material-symbols-rounded me-2">logout</i>
            Logout
          </button>
        </form>
      </div>
    </div>
  </aside>
  <!-- END SIDEBAR -->

  <!-- =========================
       MAIN CONTENT
  ========================== -->
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    <!-- =========================
         NAVBAR
    ========================== -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
      data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm">
              <a class="opacity-5 text-dark" href="#">Pages</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">
              @yield('page-title', 'Dashboard')
            </li>

          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <!-- ... isi navbar kanan ... -->
        </div>
      </div>
    </nav>
    <!-- END NAVBAR -->

    <!-- =========================
         PAGE CONTENT (custom content di sini)
    ========================== -->
    <div class="container-fluid py-4">
      @yield('content')

    </div>



  </main>
  <!-- END MAIN CONTENT -->

  <!-- =========================
       SCRIPTS
  ========================== -->
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>
  <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="/assets/js/plugins/chartjs.min.js"></script>
  <script src="/assets/js/material-dashboard.min.js?v=3.2.0"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
</body>

</html>