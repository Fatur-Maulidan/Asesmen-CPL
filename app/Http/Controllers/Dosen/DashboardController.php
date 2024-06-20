<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($kodeMataKuliah)
    {
        return view('dosen.dashboard.index', [
            'title' => 'Dashboard',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah
        ]);
    }
}
