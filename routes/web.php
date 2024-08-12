<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\LaporanKegiatanEventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute untuk halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk halaman home yang akan memanggil HomeController
Route::get('/home', [HomeController::class, 'index'])->name('home');

// events
Route::resource('events', EventController::class);

// pendaftaran
Route::resource('pendaftaran', PendaftaranController::class);
Route::get('pendaftaran/daftar/{eventId}', [PendaftaranController::class, 'daftar'])->name('pendaftaran.daftar');


// reservasi
Route::resource('reservations', ReservationController::class);

// laporan
Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/{report}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/{report}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');
});

// absensi
Route::resource('absensi', AbsensiController::class);


Route::get('/laporan-kegiatan', [LaporanKegiatanController::class, 'index'])->name('laporan-kegiatan.index');
