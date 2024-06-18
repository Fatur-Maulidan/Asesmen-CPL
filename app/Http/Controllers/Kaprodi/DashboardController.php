<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    protected $kaprodi;
    protected $kaprodiNip;
    protected $kurikulum;
    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
    }
    public function index($kurikulum)
    {
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        
        return view('kaprodi.kurikulum.dashboard', [
            'title' => 'Dashboard',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum
        ]);
    }
}
