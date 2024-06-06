<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    protected $kaprodi;
    protected $kaprodiNip;
    protected $kurikulum;
    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Dosen();
        $this->kurikulum = new Kurikulum();
    }
    public function index($kurikulum)
    {
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        return view('kaprodi.kurikulum.dashboard', [
            'title' => 'Dashboard',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum
        ]);
    }
}
