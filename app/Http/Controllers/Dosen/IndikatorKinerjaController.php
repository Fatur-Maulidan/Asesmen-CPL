<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use Illuminate\Http\Request;

class IndikatorKinerjaController extends Controller
{
    protected $mataKuliah;
    protected $indikatorKinerja;

    public function __construct()
    {
        $this->mataKuliah = new Master_07_MataKuliah();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeMataKuliah)
    {
        $dataIk = collect();
        $this->mataKuliah = $this->mataKuliah->where('kode', $kodeMataKuliah)->with('mataKuliahRegister.indikatorKinerja')->first();
        foreach($this->mataKuliah->mataKuliahRegister as $mkr){
            foreach($mkr->indikatorKinerja as $ik){
                if(!$dataIk->contains('kode', $ik->kode)){
                    $dataIk->put($ik->kode, [
                        'kode' => $ik->kode,
                        'deskripsi' => $ik->deskripsi,
                        'tujuanPembelajaran' => collect()
                    ]);
                }
                $ik->load('tujuanPembelajaran');

                foreach ($ik->tujuanPembelajaran as $tp) {
                    $dataIk[$ik->kode]['tujuanPembelajaran']->push($tp);
                }
            }
        }

        return view('dosen.indikator-kinerja.index', [
            'title' => 'Indekator Kinerja',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah,
            'data_ik' => $dataIk->sortBy('kode')
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
