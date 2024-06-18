<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_11_MataKuliahRegister;
use App\Models\MataKuliah;
use App\Models\Perkuliahan;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    protected $mataKuliah;
    protected $dosenNip;
    protected $dosen;
    protected $perkuliahan;
    protected $tahun;
    protected $kurikulum;
    protected $tahunKurikulum;
    public function __construct()
    {
        $this->tahunKurikulum = 2021;
        $this->mataKuliah = new Master_07_MataKuliah();
        $this->kurikulum = new Master_03_Kurikulum();
        // $this->dosenNip = '196012261992031001';
        $this->dosenNip = '199301062019031017';
        $this->dosen = new Master_04_Dosen();
        // $this->perkuliahan = new Master();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dosen  = $this->dosen->getDosenByNip($this->dosenNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByNomorProdi($this->dosen->programStudi->first()->nomor, $this->tahunKurikulum);
        // $mataKuliahRegister = Master_07_MataKuliah::where('03_MASTER_kurikulum_id', $this->kurikulum->id)->with('mataKuliahRegister.dosen')->get();
        $this->mataKuliah = Master_11_MataKuliahRegister::whereHas('dosen', function($query) {
            $query->where('04_MASTER_dosen_kode', $this->dosen->kode);
        })->with('dosen')->whereHas('mataKuliah', function($query) {
            $query->where('03_MASTER_kurikulum_id', $this->kurikulum->id);
        })->with('mataKuliah')->get();
        
        return view('dosen.mata-kuliah.index', [
            'title' => 'Mata Kuliah',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'title'=> 'Home',
            'mata_kuliah' => $this->mataKuliah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function informasiUmum($kodeMataKuliah)
    {
        $this->mataKuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)->with('mataKuliahRegister')->with('kurikulum.programStudi')->first();
        return view('dosen.mata-kuliah.informasi-umum', [
            'title' => 'Informasi Umum Mata Kuliah',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah,
            'mataKuliah' => $this->mataKuliah,
        ]);  
    }
}
