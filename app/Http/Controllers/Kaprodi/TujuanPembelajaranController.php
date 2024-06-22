<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_13_TujuanPembelajaran;
use Illuminate\Http\Request;

class TujuanPembelajaranController extends Controller
{
    protected $validator;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    protected $mataKuliah;
    protected $indikatorKinerja;

    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->mataKuliah = new Master_07_MataKuliah();
        $this->indikatorKinerja = new Master_09_IndikatorKinerja();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $dataTp = Master_13_TujuanPembelajaran::all();
        $dataIk = collect();

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $this->mataKuliah = $this->mataKuliah->getMataKuliahByKurikulum($this->kurikulum->id);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);

        $selectedMataKuliah = new Master_07_MataKuliah;
        $mataKuliah = request('mata_kuliah') ?? $this->mataKuliah[0]->nama;
        $selectedMataKuliah = $selectedMataKuliah->getMataKuliahByNamaAndKurikulum($mataKuliah,$this->kurikulum->id);

        foreach($this->indikatorKinerja as $ik){
            foreach($ik->mataKuliahRegister as $mkr){
                foreach($mkr->tujuanPembelajaran as $tp){
                    if($mkr->mataKuliah->kode === $selectedMataKuliah->kode){
                        if(!$dataIk->has($ik->kode)){
                            $dataIk->put($ik->kode, [
                                'indikatorKinerja' => $ik,
                                'tujuanPembelajaran' => collect()
                            ]);
                        }
                        if(!$dataIk->get($ik->kode)['tujuanPembelajaran']->contains('kode', $tp->kode)){
                            $dataIk->get($ik->kode)['tujuanPembelajaran']->push($tp);
                        }
                    }
                }
            }
        }
        
        return view('kaprodi.tp.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_mata_kuliah' => $this->mataKuliah,
            'selected_mata_kuliah' => $selectedMataKuliah,
            'data_indikator_kinerja' => $this->indikatorKinerja,
            'dataTp' => $dataTp
        ]);
    }

    public function validasi($kurikulum)
    {
        $dataTp = collect();
        $dataIk = collect();

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $this->mataKuliah = $this->mataKuliah->getMataKuliahByKurikulum($this->kurikulum->id);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);

        $selectedMataKuliah = new Master_07_MataKuliah;
        $mataKuliah = request('mata_kuliah') ?? $this->mataKuliah[0]->nama;
        $selectedMataKuliah = $selectedMataKuliah->getMataKuliahByNamaAndKurikulum($mataKuliah,$this->kurikulum->id);

        foreach($this->indikatorKinerja as $ik){
            foreach($ik->mataKuliahRegister as $mkr){
                foreach($mkr->tujuanPembelajaran as $tp){
                    if($mkr->mataKuliah->kode === $selectedMataKuliah->kode){
                        if(!$dataIk->has($ik->kode)){
                            $dataIk->put($ik->kode, [
                                'indikatorKinerja' => $ik,
                                'tujuanPembelajaran' => collect()
                            ]);
                        }
                        if(!$dataIk->get($ik->kode)['tujuanPembelajaran']->contains('kode', $tp->kode)){
                            $dataIk->get($ik->kode)['tujuanPembelajaran']->push($tp);
                        }
                    }
                }
            }
        }

        return view('kaprodi.tp.validasi', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_mata_kuliah' => $this->mataKuliah,
            'selected_mata_kuliah' => $selectedMataKuliah,
            'data_indikator_kinerja' => $this->indikatorKinerja,
        ]);
    }
}
