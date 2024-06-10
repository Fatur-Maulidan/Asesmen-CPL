<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
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
    public function __construct()
    {
        $this->tahun = 2024;
        $this->mataKuliah = new MataKuliah();
        $this->dosenNip = '196012261992031001';
        $this->dosen = new Dosen();
        $this->perkuliahan = new Perkuliahan();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->dosen  = $this->dosen->getMataKuliahRegister($this->dosenNip);
        $this->mataKuliah = $this->mataKuliah->getMataKuliahByDosen($this->dosen->mataKuliahRegister);
        return view('dosen.mata-kuliah.index', [
            'title' => 'Mata Kuliah',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'title'=> 'Home',
            'mataKuliah' => $this->mataKuliah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function informasiUmum($kodeMataKuliah)
    {
        $this->mataKuliah = MataKuliah::where('kode', $kodeMataKuliah)->with('mataKuliahRegister')->with('kurikulum.programStudi')->first();
        return view('dosen.mata-kuliah.informasi-umum', [
            'title' => 'Informasi Umum Mata Kuliah',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah,
            'mataKuliah' => $this->mataKuliah,
        ]);  
    }
}
