<?php

use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboard;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboard;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Kaprodi\DosenController;
use App\Http\Controllers\Kaprodi\KurikulumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kaprodi\MahasiswaController;
use App\Http\Controllers\Dosen\MataKuliahController;
use App\Http\Controllers\Dosen\IndikatorKinerjaController as IKDosen;
use App\Http\Controllers\Dosen\TujuanPembelajaranController;
use App\Http\Controllers\Kaprodi\TujuanPembelajaranController as TujuanPembelajaran;
use App\Http\Controllers\Dosen\RencanaAsesmenController;
use App\Http\Controllers\Kaprodi\CapaianPembelajaranLulusanController;
use App\Http\Controllers\Kaprodi\IndikatorKinerjaController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () { // , 'middleware' => ['auth', 'can:view_kurikulum']
    Route::resource('dashboard', AdminDashboard::class);

    Route::resource('jurusan', JurusanController::class)
        ->only(['index', 'store', 'update']);

    Route::resource('program-studi', ProgramStudiController::class)
        ->only(['store']);

    Route::resource('dosen', AdminDosenController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    Route::patch('dosen/toggle-status/{dosen}', [AdminDosenController::class, 'toggleStatus'])->name('dosen.toggleStatus');
});

Route::group(['prefix' => 'kaprodi', 'as' => 'kaprodi.'], function () { // , 'middleware' => ['auth', 'can:view_kurikulum']
    Route::resource('kurikulum', KurikulumController::class)
        ->only(['index', 'create', 'store']);

    Route::get('kurikulum/{kurikulum}', [DashboardController::class, 'index'])
        ->name('kurikulum.dashboard');

    Route::resource('kurikulum/{kurikulum}/cpl', CapaianPembelajaranLulusanController::class)
        ->only(['index', 'show', 'edit']);

    Route::resource('kurikulum/{kurikulum}/ik', IndikatorKinerjaController::class)
        ->only(['index', 'show', 'edit',]);

    Route::get('kurikulum/{kurikulum}/ik/{ik}/detail', [IndikatorKinerjaController::class, 'detail'])
        ->name('ik.detail');

    Route::resource('kurikulum/{kurikulum}/tp', TujuanPembelajaran::class)
        ->only(['index', 'show', 'edit',]);

    Route::resource('kurikulum/{kurikulum}/mk', MataKuliahController::class)
        ->only(['index', 'show']);

    Route::resource('kurikulum/{kurikulum}/mahasiswa', MahasiswaController::class)
        ->only(['index']);

    Route::resource('kurikulum/{kurikulum}/dosen', DosenController::class)
        ->only(['index']);
});

Route::group(['prefix' => 'dosen', 'middleware' => ['auth', 'can:view_mata_kuliah'], 'as' => 'dosen.'], function () {
    Route::prefix('/mata-kuliah')->group(function () {
        Route::get('{kodeMataKuliah}/dashboard', [DosenDashboard::class, 'index'])
            ->name('dashboard.index');

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
            Route::get('/', [TujuanPembelajaranController::class, 'index'])
                ->name('mata-kuliah.tujuan-pembelajaran');

            Route::post('/', [TujuanPembelajaranController::class, 'store'])
                ->name('mata-kuliah.tujuan-pembelajaran.store');

            Route::get('detail-informasi/{id}', [TujuanPembelajaranController::class, 'detailInformasi'])
                ->name('mata-kuliah.tujuan-pembelajaran.detail-informasi');

            Route::post('/{id}', [TujuanPembelajaranController::class, 'update'])
                ->name('mata-kuliah.tujuan-pembelajaran.update');

            Route::delete('/{id}', [TujuanPembelajaranController::class, 'destroy'])
                ->name('mata-kuliah.tujuan-pembelajaran.destroy');
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
