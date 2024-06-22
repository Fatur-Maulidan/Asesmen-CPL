<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use Illuminate\Http\Request;

class IndikatorKinerjaController extends Controller
{
    protected $user;
    protected $kurikulum;

    public function __construct()
    {
        $this->user = Master_04_Dosen::find('KO042N');
        $this->kurikulum = Master_03_Kurikulum::find(1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeMataKuliah)
    {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with('mataKuliahRegister.indikatorKinerja', 'mataKuliahRegister.tujuanPembelajaran.petaIkMk')
            ->first();

        $ik_mata_kuliah = collect();
        foreach ($mata_kuliah->mataKuliahRegister as $mkr) {
            foreach ($mkr->indikatorKinerja as $ik) {
                if (!$ik_mata_kuliah->contains('kode', $ik->kode)) {
                    $ik_mata_kuliah->push([
                        'id' => $ik->id,
                        'kode' => $ik->kode,
                        'deskripsi' => $ik->deskripsi,
                        'tp' => []
                    ]);
                }
            }

            foreach ($mkr->tujuanPembelajaran as $tp) {
                foreach ($tp->petaIkMk as $peta) {
                    $ik_mata_kuliah->transform(function ($item, $key) use ($peta, $tp) {
                        if ($item['id'] == $peta->{'09_MASTER_indikator_kinerja_id'}) {
                            $item['tp'][] = [
                                'kode' => $tp->kode,
                                'deskripsi' => $tp->deskripsi,
                            ];
                        }

                        return $item;
                    });
                }
            }
        }

        //dd($ik_mata_kuliah->values());

        return view('dosen.indikator-kinerja.index', [
            'title' => 'Indikator Kinerja',
            'nama' => $this->user->nama,
            'role' => 'Dosen',
            'kurikulum' => $this->kurikulum,
            'mata_kuliah' => $mata_kuliah,
            'ik_mata_kuliah' => $ik_mata_kuliah->sort()->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function detailInformasi($kodeMataKuliah)
    {
        // dd($kodeMataKuliah);
        return view('dosen.indikator-kinerja.detail-informasi', [
            'title' => 'Detail Informasi',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah
        ]);
    }
}
