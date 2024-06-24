<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use Illuminate\Http\Request;

class RencanaAsesmenController extends Controller
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
            ->with('mataKuliahRegister.rencanaAsesmen.tujuanPembelajaran', 'mataKuliahRegister.tujuanPembelajaran')
            ->first();

        //dd($mata_kuliah);

        return view('dosen.rencana-asesmen.index', [
            'title' => 'Rencana Asesmen',
            'nama' => $this->user->nama,
            'role' => 'Dosen',
            'kurikulum' => $this->kurikulum,
            'mata_kuliah' => $mata_kuliah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kodeMataKuliah)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kodeMataKuliah)
    {
        return view('dosen.rencana-asesmen.detail-informasi', [
            'title' => 'Detail Informasi Rencana Asesmen',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kodeMataKuliah)
    {
        return view('dosen.rencana-asesmen.ubah-detail-informasi', [
            'title' => 'Ubah Rencana Asesmen',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah,
        ]);
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
}
