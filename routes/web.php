<?php

use App\Http\Controllers\Kaprodi\CPLController;
use App\Http\Controllers\Kaprodi\DashboardController;
use App\Http\Controllers\Kaprodi\DosenController;
use App\Http\Controllers\Kaprodi\IKController as IKKaprodi;
use App\Http\Controllers\Kaprodi\KurikulumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kaprodi\MahasiswaController;
use App\Http\Controllers\Kaprodi\MKController;
use App\Http\Controllers\Kaprodi\TPController as TPKaprodi;
use App\Http\Controllers\Dosen\MataKuliahController;
use App\Http\Controllers\Dosen\IKController as IKDosen;
use App\Http\Controllers\Dosen\TPController as TPDosen;
use App\Http\Controllers\Dosen\RencanaAsesmenController;
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

Route::redirect('/', '/login');

Route::get('login', [AuthController::class, 'index'])
    ->name('login')->middleware('guest');

Route::post('login', [AuthController::class, 'authenticate']);

Route::get('logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::group(['prefix' => 'kaprodi', 'middleware' => ['auth', 'can:view_kurikulum'], 'as' => 'kaprodi.'], function () {
    Route::resource('kurikulum', KurikulumController::class)
        ->only(['index', 'create', 'store']);
    Route::get('kurikulum/{kurikulum}', [DashboardController::class, 'index'])
        ->name('kurikulum.dashboard');

    Route::resource('kurikulum/{kurikulum}/cpl', CPLController::class)
        ->only(['index', 'show', 'edit']);

    Route::resource('kurikulum/{kurikulum}/ik', IKKaprodi::class)
        ->only(['index', 'show', 'edit',]);
    Route::get('kurikulum/{kurikulum}/ik/{ik}/detail', [IKKaprodi::class, 'detail'])
        ->name('ik.detail');

    Route::resource('kurikulum/{kurikulum}/tp', TPKaprodi::class)
        ->only(['index', 'show', 'edit',]);

    Route::resource('kurikulum/{kurikulum}/mk', MKController::class)
        ->only(['index', 'show']);

    Route::resource('kurikulum/{kurikulum}/mahasiswa', MahasiswaController::class)
        ->only(['index']);

    Route::resource('kurikulum/{kurikulum}/dosen', DosenController::class)
        ->only(['index']);
});

Route::group(['prefix' => 'dosen', 'middleware' => ['auth', 'can:view_mata_kuliah'], 'as' => 'dosen.'], function () {
    Route::prefix('/mata-kuliah')->group(function () {
        Route::get('/', [MataKuliahController::class, 'index'])
            ->name('mata-kuliah');
    
        Route::get('{kodeMataKuliah}/informasi-umum', [MataKuliahController::class, 'informasiUmum'])
            ->name('mata-kuliah.informasi-umum');
    
        Route::prefix('{kodeMataKuliah}/indikator-kinerja')->group(function () {
            Route::get('/', [IKDosen::class, 'index'])
                ->name('mata-kuliah.indikator-kinerja');
    
            Route::get('detail-informasi', [IKDosen::class, 'detailInformasi'])
                ->name('mata-kuliah.indikator-kinerja.detail-informasi');
        });
    
        Route::prefix('{kodeMataKuliah}/tujuan-pembelajaran')->group(function () {
            Route::get('/', [TPDosen::class, 'index'])
                ->name('mata-kuliah.tujuan-pembelajaran');
    
            Route::post('/', [TPDosen::class, 'store'])
                ->name('mata-kuliah.tujuan-pembelajaran.store');

            Route::get('detail-informasi', [TPDosen::class, 'detailInformasi'])
                ->name('mata-kuliah.tujuan-pembelajaran.detail-informasi');
        });
    
        Route::prefix('{kodeMataKuliah}/rencana-asesmen')->group(function () {
            Route::get('/', [RencanaAsesmenController::class, 'index'])
                ->name('mata-kuliah.rencana-asesmen');
    
            Route::get('detail-informasi', [RencanaAsesmenController::class, 'detailInformasi'])
                ->name('mata-kuliah.rencana-asesmen.detail-informasi');
    
            Route::get('detail-informasi/ubah', [RencanaAsesmenController::class, 'edit'])
                ->name('mata-kuliah.rencana-asesmen.detail-informasi.ubah');
        });
        
        Route::get('nilai-mahasiswa/{kodeMataKuliah}', [RencanaAsesmenController::class, 'nilaiMahasiswa'])
                ->name('mata-kuliah.nilai-mahasiswa');
    });
});



