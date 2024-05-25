<?php

use App\Http\Controllers\Kaprodi\KurikulumController;
use App\Http\Controllers\Dosen\MataKuliahController;
use App\Http\Controllers\Dosen\TPController;
use App\Http\Controllers\Dosen\RencanaAsesmenController;
use App\Http\Controllers\AuthController;
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

Route::get('login', [AuthController::class, 'index'])
    ->name('login')->middleware('guest');

Route::post('login', [AuthController::class, 'authenticate']);

Route::get('logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::prefix('mata-kuliah')->group(function () {
    Route::get('/', [MataKuliahController::class, 'index'])
        ->name('mata-kuliah');

    Route::get('informasi-umum', [MataKuliahController::class, 'informasiUmum'])
        ->name('mata-kuliah.informasi-umum');

    // Route::prefix('indikator-kinerja')->group(function () {
    //     Route::get('/', [MataKuliahController::class, 'indikatorKinerja'])
    //         ->name('mata-kuliah.indikator-kinerja');

    //     Route::get('detail-informasi', [MataKuliahController::class, 'detailInformasiIndikatorKinerja'])
    //         ->name('mata-kuliah.indikator-kinerja.detail-informasi');
    // });

    Route::prefix('tujuan-pembelajaran')->group(function () {
        Route::get('/', [TPController::class, 'index'])
            ->name('mata-kuliah.tujuan-pembelajaran');

        Route::get('detail-informasi', [TPController::class, 'detailInformasi'])
            ->name('mata-kuliah.tujuan-pembelajaran.detail-informasi');
    });

    Route::prefix('rencana-asesmen')->group(function () {
        Route::get('/', [RencanaAsesmenController::class, 'index'])
            ->name('mata-kuliah.rencana-asesmen');

        Route::get('detail-informasi', [RencanaAsesmenController::class, 'detailInformasi'])
            ->name('mata-kuliah.rencana-asesmen.detail-informasi');

        Route::get('detail-informasi/ubah', [RencanaAsesmenController::class, 'edit'])
            ->name('mata-kuliah.rencana-asesmen.detail-informasi.ubah');

        Route::post('nilai-mahasiswa', [RencanaAsesmenController::class, 'nilaiMahasiswa'])
            ->name('mata-kuliah.rencana-asesmen.nilai-mahasiswa');
    });
});

Route::get('mata-kuliah/indikator-kinerja', function () {
    return view('dosen.indikator-kinerja.index', [
        'title' => 'Indikator Kinerja',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.indikator-kinerja');

Route::get('mata-kuliah/indikator-kinerja/detail-informasi', function () {
    return view('dosen.indikator-kinerja.detail-informasi', [
        'title' => 'Detail Informasi Indikator Kinerja',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.indikator-kinerja.detail-informasi');



Route::get('mata-kuliah/nilai-mahasiswa', function () {
    return view('dosen.nilai-mahasiswa', [
        'title' => 'Nilai Mahasiswa',
        'nama' => 'John Doe',
        'role' => 'Dosen'
    ]);
})->name('mata-kuliah.nilai-mahasiswa');

Route::redirect('/', '/kurikulum');

Route::resource('kurikulum', KurikulumController::class)
    ->only(['index', 'create', 'store']);
