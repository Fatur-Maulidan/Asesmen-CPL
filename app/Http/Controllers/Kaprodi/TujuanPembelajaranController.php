<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TujuanPembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
        $daftar_mata_kuliah = Master_07_MataKuliah::where('03_MASTER_kurikulum_id', $kurikulum->id)->get();

        $data_mata_kuliah = null;
        $tahun_akademik = collect();

        if (request('mata_kuliah') != '') {
            $mata_kuliah = Master_07_MataKuliah::with('mataKuliahRegister')
                ->find(request('mata_kuliah'));

            foreach ($mata_kuliah->mataKuliahRegister as $mkr) {
                $tahun_akademik->push([
                    'tahun_akademik_awal' => $mkr->tahun_akademik_awal,
                    'tahun_akademik_akhir' => $mkr->tahun_akademik_akhir,
                ]);
            }
        }

        if (request('mata_kuliah') != '' && request('tahun_akademik') != '') {
            $data_mata_kuliah = Master_07_MataKuliah::with(['mataKuliahRegister' => function ($query) {
                $query->where('tahun_akademik_awal', request('tahun_akademik'))->with('tujuanPembelajaran.petaIkMk.indikatorKinerja');
            }])->find(request('mata_kuliah'));
        }

        return view('kaprodi.tp.index', [
            'title' => 'Tujuan Pembelajaran',
            'kurikulum' => $kurikulum,
            'daftar_mata_kuliah' => $daftar_mata_kuliah,
            'tahun_akademik' => $tahun_akademik->unique('tahun_akademik_awal'),
            'data_mata_kuliah' => $data_mata_kuliah,
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
}
