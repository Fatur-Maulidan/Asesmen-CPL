<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ProgramStudiController as AdminProgramStudiController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;

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
use App\Http\Controllers\Dosen\NilaiMahasiswaController as DosenNilaiMahasiswaController;

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

Route::post('login', [AuthController::class, 'authenticate'])->middleware('guest');

Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')->middleware('auth');

// # Route untuk admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
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

    // # Mahasiswa
    //    Route::get('mahasiswa/download-template', [AdminMahasiswaController::class, 'downloadTemplate'])->name('mahasiswa.downloadTemplate');
    //    Route::post('mahasiswa/import', [AdminMahasiswaController::class, 'import'])->name('mahasiswa.import');
    //    Route::patch('mahasiswa/toggle-status/{mahasiswa}', [AdminMahasiswaController::class, 'toggleStatus'])->name('mahasiswa.toggleStatus');
    //    Route::resource('mahasiswa', AdminMahasiswaController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
});

// # Route untuk kaprodi
Route::group(['prefix' => 'kaprodi', 'as' => 'kaprodi.', 'middleware' => ['auth', 'kaprodi']],
    function () {
    // # Kurikulum
    Route::resource('kurikulum', KaprodiKurikulumController::class)
        ->only(['index', 'create', 'store', 'update']);

    // # Dashboard
    Route::get('kurikulum/{kurikulum}/dashboard-cpl', [KaprodiDashboardController::class, 'indexCpl'])
        ->name('kurikulum.dashboard.cpl');
    Route::get('kurikulum/{kurikulum}/dashboard-mk', [KaprodiDashboardController::class, 'indexMk'])
        ->name('kurikulum.dashboard.mk');

    // # CPL
    Route::post('kurikulum/{kurikulum}/cpl/import', [KaprodiCPLController::class, 'import'])->name('kurikulum.cpl.import');
    Route::get('kurikulum/{kurikulum}/cpl/download-template', [KaprodiCPLController::class, 'downloadTemplate'])->name('kurikulum.cpl.downloadTemplate');
    Route::resource('kurikulum/{kurikulum}/cpl', KaprodiCPLController::class)
        ->only(['index', 'show', 'store', 'edit', 'update']);

    // # Indikator Kinerja
    Route::resource('kurikulum/{kurikulum}/ik', KaprodiIndikatorKinerjaController::class)
        ->only(['index', 'show', 'store', 'edit', 'update', 'destroy']);
    Route::get('kurikulum/{kurikulum}/ik/{ik}/detail', [KaprodiIndikatorKinerjaController::class, 'detail'])
        ->name('ik.detail');

    // # Tujuan Pembelajaran
    Route::get('kurikulum/{kurikulum}/tp', [KaprodiTujuanPembelajaranController::class, 'index'])->name('tp.index');
    Route::get('kurikulum/{kurikulum}/tp/validasi', [KaprodiTujuanPembelajaranController::class, 'validasi'])->name('tp.validasi');
    Route::patch('kurikulum/{kurikulum}/tp/validasi', [KaprodiTujuanPembelajaranController::class, 'update'])->name('tp.update');

    // # Mata kuliah
    Route::get('kurikulum/{kurikulum}/mata-kuliah/download-template', [KaprodiMataKuliahController::class, 'downloadTemplate'])->name('mata-kuliah.downloadTemplate');
    Route::post('kurikulum/{kurikulum}/mata-kuliah/import', [KaprodiMataKuliahController::class, 'import'])->name('mata-kuliah.import');
    Route::patch('kurikulum/{kurikulum}/mata-kuliah/{mata_kuliah}/pemetaan', [KaprodiMataKuliahController::class, 'pemetaan'])->name('mata-kuliah.pemetaan');
    Route::resource('kurikulum/{kurikulum}/mata-kuliah', KaprodiMataKuliahController::class)
        ->only(['index', 'store', 'show', 'update']);

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
Route::group(['prefix' => 'dosen', 'as' => 'dosen.', 'middleware' => ['auth', 'dosen']], function () {
    Route::prefix('/mata-kuliah')->group(function () {

        Route::get('/', [DosenMataKuliahController::class, 'index'])
            ->name('mata-kuliah.index');
        Route::get('{kodeMataKuliah}', [DosenMataKuliahController::class, 'show'])
            ->name('mata-kuliah.show');

        // # Dashboard
        Route::get('{kodeMataKuliah}/dashboard', [DosenDashboardController::class, 'index'])
            ->name('mata-kuliah.dashboard');

        // # Indikator Kinerja
        Route::prefix('{kodeMataKuliah}/indikator-kinerja')->group(function () {
            Route::get('/', [DosenIndikatorKinerjaController::class, 'index'])
                ->name('mata-kuliah.indikator-kinerja.index');

            Route::get('{kodeIk}', [DosenIndikatorKinerjaController::class, 'show'])
                ->name('mata-kuliah.indikator-kinerja.show');
        });

        // # Tujuan Pembelajaran
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

        // # Rencana Asesmen
        Route::prefix('{kodeMataKuliah}/rencana-asesmen')->group(function () {
            Route::get('/', [DosenRencanaAsesmenController::class, 'index'])
                ->name('mata-kuliah.rencana-asesmen.index');

            Route::post('/', [DosenRencanaAsesmenController::class, 'store'])
                ->name('mata-kuliah.rencana-asesmen.store');

            Route::delete('/{id}', [DosenRencanaAsesmenController::class, 'destroy'])
                ->name('mata-kuliah.rencana-asesmen.destroy');
        });

        // # Nilai Mahasiswa
        Route::get('{kodeMataKuliah}/nilai-mahasiswa', [DosenNilaiMahasiswaController::class, 'index'])
        ->name('mata-kuliah.nilai-mahasiswa.index');
    });
});
