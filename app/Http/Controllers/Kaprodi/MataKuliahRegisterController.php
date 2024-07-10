<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRegisterRequest;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_06_Mahasiswa;
use App\Models\Master_11_MataKuliahRegister;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MataKuliahRegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(MataKuliahRegisterRequest $request, $tahun_kurikulum)
    {
        if ($request->ajax()) {
            $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
            $mahasiswa = Master_06_Mahasiswa::where('03_MASTER_kurikulum_id', $kurikulum->id)->get(['nim']);

            $validated = $request->validated();

            $exists = Master_11_MataKuliahRegister::where('tahun_akademik_awal', $validated['tahun_mulai'])
                ->where('jenis', $validated['jenis'])
                ->where('07_MASTER_mata_kuliah_id', $validated['id_mata_kuliah'])
                ->first();

            if ($exists) {
                return response()->json([
                    'message' => 'Tahun akademik sudah terdaftar.',
                ], 409);
            }

            try {
                DB::transaction(function () use ($validated, $mahasiswa) {
                    $mkr = Master_11_MataKuliahRegister::create([
                        'tahun_akademik_awal' => $validated['tahun_mulai'],
                        'tahun_akademik_akhir' => $validated['tahun_selesai'],
                        'semester' => $validated['semester'],
                        'jenis' => $validated['jenis'],
                        '07_MASTER_mata_kuliah_id' => $validated['id_mata_kuliah']
                    ]);

                    $mkr->dosen()->attach($validated['dosen_pengampu']);
                    $mkr->indikatorKinerja()->attach($validated['indikator_kinerja']);
                    $mkr->mahasiswa()->attach($mahasiswa);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil disimpan',
            ], 201);
        }
    }
}
