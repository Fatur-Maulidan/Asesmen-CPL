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
    protected $tujuanPembelajaran;

    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->mataKuliah = new Master_07_MataKuliah();
        $this->indikatorKinerja = new Master_09_IndikatorKinerja();
        $this->tujuanPembelajaran = new Master_13_TujuanPembelajaran();
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

        $dataMataKuliah = Master_07_MataKuliah::where('kode', $selectedMataKuliah->kode)
            ->with('mataKuliahRegister.indikatorKinerja', 'mataKuliahRegister.tujuanPembelajaran.petaIkMk')
            ->first();
        
        $ikMataKuliah = collect();
        foreach ($dataMataKuliah->mataKuliahRegister as $mkr) {
            foreach ($mkr->indikatorKinerja as $ik) {
                if (!$ikMataKuliah->contains('kode', $ik->kode)) {
                    $ikMataKuliah->push([
                        'id' => $ik->id,
                        'kode' => $ik->kode,
                        'deskripsi' => $ik->deskripsi,
                        'tp' => []
                    ]);
                }
            }

            foreach ($mkr->tujuanPembelajaran as $tp) {
                foreach ($tp->petaIkMk as $peta) {
                    $ikMataKuliah->transform(function ($item, $key) use ($peta, $tp) {
                        if ($item['id'] == $peta->{'09_MASTER_indikator_kinerja_id'} && $tp->status_validasi == null && $tp->alasan_penolakan == null) {
                            $item['tp'][] = [
                                'id' => $tp->id,
                                'kode' => $tp->kode,
                                'deskripsi' => $tp->deskripsi,
                            ];
                        }
                        return $item;
                    });
                }
            }
        }
        $ik = request('indikator_kinerja') ?? ($ikMataKuliah[0]['kode'] ?? null);
        $selectedIndikatorKinerja = new Master_09_IndikatorKinerja;
        $selectedIndikatorKinerja = $ik != null ? $selectedIndikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, '', $ik)->first() : $ik;
        return view('kaprodi.tp.validasi', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_mata_kuliah' => $this->mataKuliah,
            'data_indikator_kinerja' => $this->indikatorKinerja,
            'ik_mata_kuliah' => $ikMataKuliah->sort(),
            'selected_mata_kuliah' => $selectedMataKuliah,
            'selected_indikator_kinerja' => $selectedIndikatorKinerja
        ]);
    }

    public function update(Request $request, $kurikulum){
        $statusButton = $request->input('btn');
        $tp[] = $request->input('tp_id');
        $this->tujuanPembelajaran = $this->tujuanPembelajaran->getDataTpById($request->input('tp_id'));
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);

        switch ( $statusButton ) {
            case 'tolak_semua':
                return $this->rejectOrApproveDataTp('Ditolak', $this->tujuanPembelajaran, $this->kurikulum);
            case 'setujui_semua':
                return $this->rejectOrApproveDataTp('Disetujui', $this->tujuanPembelajaran, $this->kurikulum);
            case 'simpan':
                return $this->saveUpdateDataTp("", $tp);
        }
    }
    
    // Ditolak
    private function rejectOrApproveDataTp($status = "", $dataTp, $kurikulum){
        foreach($dataTp as $tp) {
            $tp->status_validasi = $status;
            $tp->save();
        }
        return redirect()->route('kaprodi.tp.validasi', ['kurikulum' => $kurikulum->tahun]);
    }

    private function saveUpdateDataTp($request, $tp) {

    }
}
