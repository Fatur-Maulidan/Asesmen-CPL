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

Route::redirect('/', '/kurikulum');

Route::resource('kurikulum', KurikulumController::class)
    ->only(['index', 'create', 'store'])
    ->names([
        'index' => 'kurikulum.index',
        'create' => 'kurikulum.create',
        'store' => 'kurikulum.store'
    ]);
