<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Requests\RencanaAsesmenRequest;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_15_RencanaAsesmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RencanaAsesmenController extends Controller
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
            }],'mataKuliahRegister.rencanaAsesmen.tujuanPembelajaran', 'mataKuliahRegister.tujuanPembelajaran')
            ->first();

        return view('dosen.rencana-asesmen.index', [
            'title' => 'Rencana Asesmen',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            'mata_kuliah' => $mata_kuliah,
            'kurikulum' => $mata_kuliah->kurikulum
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RencanaAsesmenRequest $request, $kodeMataKuliah, $jenis)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($kodeMataKuliah, $validated) {
            $rencana_asesmen = Master_15_RencanaAsesmen::create([
                'kode' => $validated['kategori'] . '#' . $validated['urutan'],
                'kategori' => $validated['kategori'],
                'minggu' => $validated['minggu'],
                '11_MASTER_mk_register_id' => $validated['mata_kuliah'],
            ]);

            // Map rencana asesmen with tujuan pembelajaran
            $rencana_asesmen->tujuanPembelajaran()->attach($validated['tp']);

            // Map rencana asesmen with mahasiswa
            $mahasiswa = $rencana_asesmen->mataKuliahRegister->mahasiswa->pluck('nim')->toArray();
            //dd($mahasiswa);
            $rencana_asesmen->mahasiswa()->attach($mahasiswa);
        });
        return redirect()->route('dosen.mata-kuliah.rencana-asesmen.index', ['kodeMataKuliah' => $kodeMataKuliah, 'jenis' => $jenis]);
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
    public function destroy($kodeMataKuliah, $jenis,$id)
    {
        DB::transaction(function () use ($id) {
            $rencana_asesmen = Master_15_RencanaAsesmen::find($id);
            $tp = $rencana_asesmen->tujuanPembelajaran->pluck('id')->toArray();
            $mahasiswa = $rencana_asesmen->mahasiswa->pluck('nim')->toArray();
            $rencana_asesmen->tujuanPembelajaran()->detach($tp);
            $rencana_asesmen->mahasiswa()->detach($mahasiswa);
            $rencana_asesmen->delete();
        });

        return redirect()->route('dosen.mata-kuliah.rencana-asesmen.index', ['kodeMataKuliah' => $kodeMataKuliah, 'jenis' => $jenis]);
    }
}
