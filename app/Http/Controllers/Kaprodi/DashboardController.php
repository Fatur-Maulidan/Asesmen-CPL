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

        $ketercapaian_cp = DB::table('01_ANALISIS_ketercapaian_mahasiswa as cp_mahasiswa')
            ->join('08_MASTER_capaian_pembelajaran_lulusan as table_cp', 'table_cp.id', '=', 'cp_mahasiswa.id_cpl')
            ->select(['nim', 'nama_mata_kuliah', 'kode_mata_kuliah', 'kode_cpl', 'kode_ik', 'kode_tp', 'table_cp.deskripsi'])
            ->selectRaw('SUM(ketercapaian_tp) as ketercapaian_cp')
            ->groupBy(['kode_tp', 'kode_ik', 'kode_cpl'])
            ->get();

        $labels_cp = [];
        $data_cp = [];

        foreach ($ketercapaian_cp as $cp) {
            array_push($labels_cp, $cp->kode_cpl);
            array_push($data_cp, $cp->ketercapaian_cp);
        }

        $data_chart_cp = [
            'labels' => $labels_cp,
            'data' => $data_cp,
        ];

        //dd($data_chart_cp, $ketercapaian_cp);

        return view('kaprodi.kurikulum.dashboard_cpl', [
            'title' => 'Dashboard',
            'kurikulum' => $kurikulum,
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
