<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index($kurikulum)
    {
        return view('kaprodi.kurikulum.dashboard', [
            'title' => 'Dashboard',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum
        ]);
    }
}
