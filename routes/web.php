<?php

use App\Http\Controllers\Kaprodi\CPLController;
use App\Http\Controllers\Kaprodi\DashboardController;
use App\Http\Controllers\Kaprodi\IKController;
use App\Http\Controllers\Kaprodi\KurikulumController;
use App\Http\Controllers\Kaprodi\MahasiswaController;
use App\Http\Controllers\Kaprodi\MKController;
use App\Http\Controllers\Kaprodi\TPController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    return view('login', [
        'title' => 'Login',
        'isLoginView' => true
    ]);
});

Route::get('mata-kuliah', function () {
    return view('dosen.home', [
        'title' => 'Mata Kuliah',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah');

Route::get('mata-kuliah/informasi-umum', function () {
    return view('dosen.informasi-umum', [
        'title' => 'Informasi Umum Mata Kuliah',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.informasi-umum');

Route::get('mata-kuliah/indikator-kinerja', function () {
    return view('dosen.indikator-kinerja', [
        'title' => 'Indikator Kinerja',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.indikator-kinerja');

Route::get('mata-kuliah/indikator-kinerja/detail-informasi', function () {
    return view('dosen.detail-informasi-indikator-kinerja', [
        'title' => 'Detail Informasi Indikator Kinerja',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.indikator-kinerja.detail-informasi');

Route::get('mata-kuliah/tujuan-pembelajaran', function () {
    return view('dosen.tujuan-pembelajaran', [
        'title' => 'Tujuan Pembelajaran',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.tujuan-pembelajaran');

Route::get('mata-kuliah/tujuan-pembelajaran/detail-informasi', function () {
    return view('dosen.detail-informasi-tujuan-pembelajaran', [
        'title' => 'Detail Informasi Tujuan Pembelajaran',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.tujuan-pembelajaran.detail-informasi');

Route::get('mata-kuliah/rencana-asesmen', function () {
    return view('dosen.rencana-asesmen', [
        'title' => 'Rencana Asesmen',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.rencana-asesmen');

Route::get('mata-kuliah/rencana-asesmen/detail-informasi', function () {
    return view('dosen.detail-informasi-rencana-asesmen', [
        'title' => 'Detail Informasi Rencana Asesmen',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.rencana-asesmen.detail-informasi');

Route::get('mata-kuliah/rencana-asesmen/detail-informasi/ubah', function () {
    return view('dosen.ubah-detail-informasi-rencana-asesmen', [
        'title' => 'Ubah Rencana Asesmen',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.rencana-asesmen.detail-informasi.ubah');

Route::get('mata-kuliah/nilai-mahasiswa', function () {
    return view('dosen.nilai-mahasiswa', [
        'title' => 'Nilai Mahasiswa',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.nilai-mahasiswa');

Route::redirect('/', '/kaprodi/kurikulum');

Route::prefix('kaprodi')->group(function () {
    Route::resource('kurikulum', KurikulumController::class)->only(['index', 'create', 'store']);
    Route::get('kurikulum/{kurikulum}', [DashboardController::class, 'index'])->name('kurikulum.dashboard');

    Route::resource('kurikulum/{kurikulum}/cpl', CPLController::class)->only(['index', 'show', 'edit']);

    Route::resource('kurikulum/{kurikulum}/ik', IKController::class)->only(['index', 'show', 'edit',]);
    Route::get('kurikulum/{kurikulum}/ik/{ik}/detail', [IKController::class, 'detail'])->name('ik.detail');

    Route::resource('kurikulum/{kurikulum}/tp', TPController::class)->only(['index', 'show', 'edit',]);

    Route::resource('kurikulum/{kurikulum}/mk', MKController::class)->only(['index', 'show']);

    Route::resource('kurikulum/{kurikulum}/mahasiswa', MahasiswaController::class)->only(['index']);
});
