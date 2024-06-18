<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use Illuminate\Http\Request;

class TujuanPembelajaranController extends Controller
{
    protected $validator;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    protected $mataKuliah;

    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->mataKuliah = new Master_07_MataKuliah();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $this->mataKuliah = $this->mataKuliah->getMataKuliahByKurikulum($this->kurikulum->id);
        $selectedMataKuliah = new Master_07_MataKuliah;
        $mataKuliah = request('mata_kuliah') ?? $this->mataKuliah[0]->nama;
        $selectedMataKuliah = $selectedMataKuliah->getMataKuliahByNamaAndKurikulum($mataKuliah,$this->kurikulum->id);

        return view('kaprodi.tp.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_mata_kuliah' => $this->mataKuliah,
            'selected_mata_kuliah' => $selectedMataKuliah,
        ]);
    }
}
