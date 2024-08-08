<?php

namespace App\Http\Controllers\Kaprodi;

use App\Enums\DomainCPL;
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

        $filter = DomainCPL::Sikap;
        if (request('domain')) {
            switch (request('domain')) {
                case 'sikap':
                    $filter = DomainCPL::Sikap;
                    break;
                case 'pengetahuan':
                    $filter = DomainCPL::Pengetahuan;
                    break;
                case 'keterampilan-umum':
                    $filter = DomainCPL::KeterampilanUmum;
                    break;
                case 'keterampilan-khusus':
                    $filter = DomainCPL::KeterampilanKhusus;
                    break;
            }
        }

        $ketercapaian_cp = DB::table('08_MASTER_capaian_pembelajaran_lulusan as cpl')
            ->where('03_MASTER_kurikulum_id', $kurikulum->id)
            ->where('cpl.domain', $filter)
            ->leftJoin('01_ANALISIS_ketercapaian_mahasiswa as ktmhs', 'cpl.id', '=', 'ktmhs.id_cpl')
            ->select(['cpl.kode', 'cpl.deskripsi'])
            ->selectRaw('SUM(ktmhs.ketercapaian_tp) as ketercapaian')
            ->groupBy('cpl.id')
            ->get();

        $labels = $ketercapaian_cp->pluck('kode')->toArray();
        $data = $ketercapaian_cp->map(function ($item) {
           return (float) $item->ketercapaian;
        });

        return view('kaprodi.kurikulum.dashboard_cpl', [
            'title' => 'Dashboard',
            'kurikulum' => $kurikulum,
            'ketercapaian_cp' => $ketercapaian_cp,
            'labels' => $labels,
            'data' => $data,
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
