<?php

use App\Http\Controllers\Kaprodi\KurikulumController;
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

Route::redirect('/', '/kurikulum');

Route::resource('kurikulum', KurikulumController::class)
    ->only(['index', 'create', 'store']);
