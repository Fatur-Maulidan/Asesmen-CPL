<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndikatorKinerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeMataKuliah, $jenis)
    {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }] ,'mataKuliahRegister.indikatorKinerja', 'mataKuliahRegister.tujuanPembelajaran.petaIkMk')
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
        return view('dosen.indikator-kinerja.index', [
            'title' => 'Indikator Kinerja',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            // 'kurikulum' => $this->kurikulum,
            'mata_kuliah' => $mata_kuliah,
            'ik_mata_kuliah' => $ik_mata_kuliah->sort()->all(),
            'kurikulum' => $mata_kuliah->kurikulum,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kodeMataKuliah, $jenis ,$kodeIk)
    {

        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with('mataKuliahRegister.indikatorKinerja', 'mataKuliahRegister.tujuanPembelajaran.petaIkMk')
            ->first();

        $indikator_kinerja = Master_09_IndikatorKinerja::with('mataKuliahRegister')
            ->where('kode', $kodeIk)
            ->first();

        return view('dosen.indikator-kinerja.show', [
            'title' => 'Detail Indikator Kinerja',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            'mata_kuliah' => $mata_kuliah,
            'indikator_kinerja' => $indikator_kinerja,
        ]);
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
