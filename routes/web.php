<?php

use App\Http\Controllers\Kaprodi\CPLController;
use App\Http\Controllers\Kaprodi\DashboardController;
use App\Http\Controllers\Kaprodi\IKController;
use App\Http\Controllers\Kaprodi\KurikulumController;
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

Route::redirect('/', '/kurikulum');

Route::resource('kurikulum', KurikulumController::class)->only(['index', 'create', 'store']);
Route::get('{kurikulum}', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('{kurikulum}/cpl', CPLController::class)->only(['index', 'show', 'edit',]);
Route::resource('{kurikulum}/ik', IKController::class)->only(['index', 'show', 'edit',]);
Route::get('{kurikulum}/ik/{ik}/detail', [IKController::class, 'detail'])->name('ik.detail');
Route::resource('{kurikulum}/tp', TPController::class)->only(['index', 'show', 'edit',]);
