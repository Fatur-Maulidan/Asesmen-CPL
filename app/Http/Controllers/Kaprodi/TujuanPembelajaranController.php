<?php

namespace App\Http\Controllers\Kaprodi;

use App\Enums\StatusValidasiTP;
use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_13_TujuanPembelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function validasi($tahun_kurikulum)
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

        return view('kaprodi.tp.validasi', [
            'title' => 'Validasi Tujuan Pembelajaran',
            'kurikulum' => $kurikulum,
            'daftar_mata_kuliah' => $daftar_mata_kuliah,
            'tahun_akademik' => $tahun_akademik->unique('tahun_akademik_awal'),
            'data_mata_kuliah' => $data_mata_kuliah,
        ]);
    }

    public function update(Request $request, $tahun_kurikulum)
    {
        $data_tp = $request->post('tp');

        DB::transaction(function () use ($data_tp) {
            foreach ($data_tp as $value) {
                $tp = Master_13_TujuanPembelajaran::find($value['id']);

                if ($value['status'] == 'Disetujui') {
                    $tp->update([
                        'status' => $value['status'],
                        'tanggal_divalidasi' => now(),
                    ]);
                } else if ($value['status'] == 'Ditolak') {
                    $tp->update([
                        'status' => $value['status'],
                        'alasan_penolakan' => $value['alasan_penolakan'],
                    ]);
                }
            }
        });

        return redirect()->route('kaprodi.tp.index', ['kurikulum' => $tahun_kurikulum]);
    }
}
