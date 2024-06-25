<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\TujuanPembelajaranStoreRequest;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $user;
    protected $kurikulum;

    public function __construct(){
        $this->user = Master_04_Dosen::find('KO042N');
        $this->kurikulum = Master_03_Kurikulum::find(1);
    }

    public function index($kodeMataKuliah)
    {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->first();

        return view('dosen.dashboard.index', [
            'title' => 'Dashboard',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kurikulum' => $this->kurikulum,
            'mata_kuliah' => $mata_kuliah
        ]);
    }
}
