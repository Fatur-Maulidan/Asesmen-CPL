<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function indexCpl($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        $ketercapaian_tp = DB::table('01_ANALISIS_ketercapaian_mahasiswa as cp_mahasiswa')
            ->join('13_MASTER_tujuan_pembelajaran as table_tp', 'table_tp.id', '=', 'cp_mahasiswa.id_tp')
            ->select(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik', 'kode_tp', 'table_tp.deskripsi'])
            ->selectRaw('SUM(ketercapaian_tp) as ketercapaian_tp')
            ->where('id_mata_kuliah', 4)
            ->where('nim', '211511003')
            ->groupBy(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik', 'kode_tp'])
            ->get();

        $ketercapaian_ik = DB::table('01_ANALISIS_ketercapaian_mahasiswa as cp_mahasiswa')
            ->join('09_MASTER_indikator_kinerja as table_ik', 'table_ik.id', '=', 'cp_mahasiswa.id_ik')
            ->select(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik', 'kode_tp', 'table_ik.deskripsi'])
            ->selectRaw('SUM(ketercapaian_tp) as ketercapaian_ik')
            ->where('id_mata_kuliah', 4)
            ->where('nim', '211511003')
            ->groupBy(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik'])
            ->get();

        $ketercapaian_cp = DB::table('01_ANALISIS_ketercapaian_mahasiswa as cp_mahasiswa')
            ->join('08_MASTER_capaian_pembelajaran_lulusan as table_cp', 'table_cp.id', '=', 'cp_mahasiswa.id_cpl')
            ->select(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik', 'kode_tp', 'table_cp.deskripsi'])
            ->selectRaw('SUM(ketercapaian_tp) as ketercapaian_cp')
            ->where('id_mata_kuliah', 4)
            ->where('nim', '211511003')
            ->groupBy(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl'])
            ->get();

        //dd($ketercapaian);
        $labels_tp = [];
        $labels_ik = [];
        $labels_cp = [];
        $data_tp = [];
        $data_ik = [];
        $data_cp = [];

        foreach ($ketercapaian_tp as $tp) {
            array_push($labels_tp, $tp->kode_tp);
            array_push($data_tp, $tp->ketercapaian_tp);
        }

        foreach ($ketercapaian_ik as $ik) {
            array_push($labels_ik, $ik->kode_ik);
            array_push($data_ik, $ik->ketercapaian_ik);
        }

        foreach ($ketercapaian_cp as $cp) {
            array_push($labels_cp, $cp->kode_cpl);
            array_push($data_cp, $cp->ketercapaian_cp);
        }

        $data_chart_tp = [
            'labels' => $labels_tp,
            'data' => $data_tp,
        ];

        $data_chart_ik = [
            'labels' => $labels_ik,
            'data' => $data_ik,
        ];

        $data_chart_cp = [
            'labels' => $labels_cp,
            'data' => $data_cp,
        ];

        //dd($data_chart_cp, $ketercapaian_cp);

        return view('kaprodi.kurikulum.dashboard_cpl', [
            'title' => 'Dashboard',
            'kurikulum' => $kurikulum,
            'data_chart_tp' => $data_chart_tp,
            'ketercapaian_tp' => $ketercapaian_tp,
            'data_chart_ik' => $data_chart_ik,
            'ketercapaian_ik' => $ketercapaian_ik,
            'data_chart_cp' => $data_chart_cp,
            'ketercapaian_cp' => $ketercapaian_cp,
        ]);
    }

    public function indexMk($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);


        return view('kaprodi.kurikulum.dashboard_mk', [
            'title' => 'Dashboard',
            'kurikulum' => $kurikulum
        ]);
    }
}
