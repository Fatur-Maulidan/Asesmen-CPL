<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProgramStudiController as AdminProgramStudiController;

use App\Http\Controllers\Kaprodi\KurikulumController as KaprodiKurikulumController;
use App\Http\Controllers\Kaprodi\DashboardController as KaprodiDashboardController;
use App\Http\Controllers\Kaprodi\CapaianPembelajaranLulusanController as KaprodiCPLController;
use App\Http\Controllers\Kaprodi\IndikatorKinerjaController as KaprodiIndikatorKinerjaController;
use App\Http\Controllers\Kaprodi\TujuanPembelajaranController as KaprodiTujuanPembelajaranController;
use App\Http\Controllers\Kaprodi\MataKuliahController as KaprodiMataKuliahController;
use App\Http\Controllers\Kaprodi\MahasiswaController as KaprodiMahasiswaController;
use App\Http\Controllers\Kaprodi\DosenController as KaprodiDosenController;

use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Dosen\MataKuliahController as DosenMataKuliahController;
use App\Http\Controllers\Dosen\IndikatorKinerjaController as DosenIndikatorKinerjaController;
use App\Http\Controllers\Dosen\TujuanPembelajaranController as DosenTujuanPembelajaranController;
use App\Http\Controllers\Dosen\RencanaAsesmenController as DosenRencanaAsesmenController;

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

// # Route untuk admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () { // , 'middleware' => ['auth', 'can:view_kurikulum']
    // # Dashboard
    Route::resource('dashboard', AdminDashboard::class);

    // # Jurusan
    Route::resource('jurusan', AdminJurusanController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    Route::get('jurusan/download-template', [AdminJurusanController::class, 'downloadTemplate'])->name('jurusan.downloadTemplate');
    Route::post('jurusan/import', [AdminJurusanController::class, 'import'])->name('jurusan.import');

    // # Program studi
    Route::get('program-studi/download-template', [AdminProgramStudiController::class, 'downloadTemplate'])
        ->name('program-studi.downloadTemplate');
    Route::post('program-studi/import', [AdminProgramStudiController::class, 'import'])->name('program-studi.import');
    Route::resource('program-studi', AdminProgramStudiController::class)
        ->only(['store', 'destroy']);

    // # Dosen
    Route::get('dosen/download-template', [AdminDosenController::class, 'downloadTemplate'])->name('dosen.downloadTemplate');
    Route::post('dosen/import', [AdminDosenController::class, 'import'])->name('dosen.import');
    Route::patch('dosen/toggle-status/{dosen}', [AdminDosenController::class, 'toggleStatus'])->name('dosen.toggleStatus');
    Route::resource('dosen', AdminDosenController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
});

// # Route untuk kaprodi
Route::group(['prefix' => 'kaprodi', 'as' => 'kaprodi.'], function () { // , 'middleware' => ['auth', 'can:view_kurikulum']
    // # Kurikulum
    Route::resource('kurikulum', KaprodiKurikulumController::class)
        ->only(['index', 'create', 'store']);

    // # Dashboard
    Route::get('kurikulum/{kurikulum}', [KaprodiDashboardController::class, 'index'])
        ->name('kurikulum.dashboard');

    // # CPL
    Route::resource('kurikulum/{kurikulum}/cpl', KaprodiCPLController::class)
        ->only(['index', 'show', 'store', 'edit', 'update']);

    // # Indikator Kinerja
    Route::resource('kurikulum/{kurikulum}/ik', KaprodiIndikatorKinerjaController::class)
        ->only(['index', 'show', 'store', 'edit', 'update']);
    Route::get('kurikulum/{kurikulum}/ik/{ik}/detail', [KaprodiIndikatorKinerjaController::class, 'detail'])
        ->name('ik.detail');

    // # Tujuan Pembelajaran
    Route::resource('kurikulum/{kurikulum}/tp', KaprodiTujuanPembelajaranController::class)
        ->only(['index', 'show', 'edit',]);

    // # Mata kuliah
    Route::resource('kurikulum/{kurikulum}/mk', KaprodiMataKuliahController::class)
        ->only(['index', 'show']);

    // # Mahasiswa
    Route::get('kurikulum/{kurikulum}/mahasiswa/download-template', [KaprodiMahasiswaController::class, 'downloadTemplate'])->name('mahasiswa.downloadTemplate');
    Route::post('kurikulum/{kurikulum}/mahasiswa/import', [KaprodiMahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::patch('kurikulum/{kurikulum}/mahasiswa/toggle-status/{mahasiswa}', [KaprodiMahasiswaController::class, 'toggleStatus'])->name('mahasiswa.toggleStatus');
    Route::resource('kurikulum/{kurikulum}/mahasiswa', KaprodiMahasiswaController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);

    // # Dosen
    Route::patch('dosen/toggle-status/{dosen}', [KaprodiDosenController::class, 'toggleStatus'])->name('dosen.toggleStatus');
    Route::resource('kurikulum/{kurikulum}/dosen', KaprodiDosenController::class)
        ->only(['index', 'show', 'update', 'destroy']);
});

// # Route untuk dosen
Route::group(['prefix' => 'dosen', 'middleware' => ['auth', 'can:view_mata_kuliah'], 'as' => 'dosen.'], function () {
    Route::prefix('/mata-kuliah')->group(function () {
        Route::get('{kodeMataKuliah}/dashboard', [DosenDashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::get('/', [DosenMataKuliahController::class, 'index'])
            ->name('mata-kuliah');

        Route::get('{kodeMataKuliah}/informasi-umum', [DosenMataKuliahController::class, 'informasiUmum'])
            ->name('mata-kuliah.informasi-umum');

        Route::prefix('{kodeMataKuliah}/indikator-kinerja')->group(function () {
            Route::get('/', [DosenIndikatorKinerjaController::class, 'index'])
                ->name('mata-kuliah.indikator-kinerja');

            Route::get('detail-informasi', [DosenIndikatorKinerjaController::class, 'detailInformasi'])
                ->name('mata-kuliah.indikator-kinerja.detail-informasi');
        });

        Route::prefix('{kodeMataKuliah}/tujuan-pembelajaran')->group(function () {
            Route::get('/', [DosenTujuanPembelajaranController::class, 'index'])
                ->name('mata-kuliah.tujuan-pembelajaran');

            Route::post('/', [DosenTujuanPembelajaranController::class, 'store'])
                ->name('mata-kuliah.tujuan-pembelajaran.store');

            Route::get('detail-informasi/{id}', [DosenTujuanPembelajaranController::class, 'detailInformasi'])
                ->name('mata-kuliah.tujuan-pembelajaran.detail-informasi');

            Route::post('/{id}', [DosenTujuanPembelajaranController::class, 'update'])
                ->name('mata-kuliah.tujuan-pembelajaran.update');

            Route::delete('/{id}', [DosenTujuanPembelajaranController::class, 'destroy'])
                ->name('mata-kuliah.tujuan-pembelajaran.destroy');
        });

        Route::prefix('{kodeMataKuliah}/rencana-asesmen')->group(function () {
            Route::get('/', [DosenRencanaAsesmenController::class, 'index'])
                ->name('mata-kuliah.rencana-asesmen');

            Route::get('detail-informasi', [DosenRencanaAsesmenController::class, 'detailInformasi'])
                ->name('mata-kuliah.rencana-asesmen.detail-informasi');

            Route::get('detail-informasi/ubah', [DosenRencanaAsesmenController::class, 'edit'])
                ->name('mata-kuliah.rencana-asesmen.detail-informasi.ubah');
        });

        Route::get('nilai-mahasiswa/{kodeMataKuliah}', [DosenRencanaAsesmenController::class, 'nilaiMahasiswa'])
            ->name('mata-kuliah.nilai-mahasiswa');
    });
});
