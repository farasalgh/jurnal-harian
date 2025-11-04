<?php

use App\Http\Controllers\Admin\AbsenController as AdminAbsenController;
use App\Http\Controllers\Admin\DudiCOntroller;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\Siswa\AbsenController;
use App\Http\Controllers\Siswa\KegiatanController;
use App\Http\Controllers\Siswa\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login/store', [AuthController::class, 'login'])->name('login.store');
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [DashbordController::class, 'admin'])->name('admin.dashboard');
Route::get('/pembimbing/dashboard', [DashbordController::class, 'pembimbing'])->name('pembimbing.dashboard');
Route::get('/siswa/dashboard', [DashbordController::class, 'siswa'])->name('siswa.dashboard');

//Admin Crud
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/absen/by-date', [AdminAbsenController::class, 'getByDate'])->name('absen.by-date');
        Route::get('/dashboard', [DashbordController::class, 'admin'])->name('dashboard');
        Route::resource('kelas', KelasController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('pembimbing', PembimbingController::class);
        Route::resource('jurusan', JurusanController::class, );
        Route::resource('dudi', DudiCOntroller::class);
        Route::resource('kegiatan',AdminKegiatanController::class);
        Route::resource('absen', AdminAbsenController::class);
    });
});

Route::prefix('pembimbing')->name('pembimbing.')->middleware('auth')->group(function () {

    Route::middleware(['auth', 'role:pembimbing'])->group(function () {
        Route::get('/dashboard', [DashbordController::class, 'pembimbing'])->name('dashboard');
    });
});

Route::prefix('siswa')->name('siswa.')->middleware('auth')->group(function () {


    Route::middleware(['auth', 'role:siswa'])->group(function () {
        Route::get('/absen/by-date', [AbsenController::class, 'getByDate'])->name('absen.by-date');
        Route::get('/dashboard', [DashbordController::class, 'siswa'])->name('dashboard');
        Route::resource('profile', ProfileController::class);
        Route::resource('kegiatan', KegiatanController::class);
        Route::resource('absen', AbsenController::class);
    });
});

