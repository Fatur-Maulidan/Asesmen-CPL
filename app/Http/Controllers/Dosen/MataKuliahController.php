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
use Illuminate\Support\Facades\Auth;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mata_kuliah = Master_11_MataKuliahRegister::with(['dosen' => function($query) {
                $query->where('04_MASTER_dosen_id', Auth::user()->id);
            }], 'mataKuliah')
            ->get();

        return view('dosen.mata-kuliah.index', [
            'title' => 'Mata Kuliah',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            'title'=> 'Home',
            'mata_kuliah' => $mata_kuliah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($kodeMataKuliah)
    {
        /* Kode ini digunakan ketika jenis MK Teori dan Praktek dipisah */
        // $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
        //     ->with(['mataKuliahRegister' => function($query) use ($jenis) {
        //         $query->where('jenis', $jenis);
        //     }],'mataKuliahRegister.indikatorKinerja.capaianPembelajaranLulusan', 'mataKuliahRegister.tujuanPembelajaran')
        //     ->first();
        
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with('mataKuliahRegister.indikatorKinerja.capaianPembelajaranLulusan', 'mataKuliahRegister.tujuanPembelajaran')
            ->first();

        $cpl_mata_kuliah = $this->extractCapaianPembelajaran($mata_kuliah);
        $ik_mata_kuliah = $this->extractIndikatorKinerja($mata_kuliah);
        $tp_mata_kuliah = $this->extractTujuanPembelajaran($mata_kuliah);

        return view('dosen.mata-kuliah.show', [
            'title' => 'Informasi Umum Mata Kuliah',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            'mata_kuliah' => $mata_kuliah,
            'cpl_mata_kuliah' => $cpl_mata_kuliah->sort(),
            'ik_mata_kuliah' => $ik_mata_kuliah->sort(),
            'tp_mata_kuliah' => $tp_mata_kuliah->sort(),
        ]);
    }

    public function extractTujuanPembelajaran($mataKuliah){
        $tp_mata_kuliah = collect();
        foreach ($mataKuliah->mataKuliahRegister as $mkr) {
            foreach ($mkr->tujuanPembelajaran as $tp) {
                $tp_mata_kuliah->push(['kode' => $tp->kode, 'deskripsi' => $tp->deskripsi]);
            }
        }
        return $tp_mata_kuliah;
    }

    public function extractIndikatorKinerja($mataKuliah){
        $ik_mata_kuliah = collect();
        foreach ($mataKuliah->mataKuliahRegister as $mkr) {
            foreach ($mkr->indikatorKinerja as $ik) {
                if (!$ik_mata_kuliah->contains('kode', $ik->kode)) {
                    $ik_mata_kuliah->push(['kode' => $ik->kode, 'deskripsi' => $ik->deskripsi]);
                }
            }
        }
        return $ik_mata_kuliah;
    }

    public function extractCapaianPembelajaran($mataKuliah){
        $cpl_mata_kuliah = collect();
        foreach ($mataKuliah->mataKuliahRegister as $mkr) {
            foreach ($mkr->indikatorKinerja as $ik) {
                if (!$cpl_mata_kuliah->contains('kode', $ik->capaianPembelajaranLulusan->kode)) {
                    $cpl_mata_kuliah->push(['kode' => $ik->capaianPembelajaranLulusan->kode, 'deskripsi' => $ik->capaianPembelajaranLulusan->deskripsi]);
                }
            }
        }
        return $cpl_mata_kuliah;
    }
}
