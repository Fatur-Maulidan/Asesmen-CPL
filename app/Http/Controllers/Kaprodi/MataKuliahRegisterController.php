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
                DB::transaction(function () use ($validated) {
                    $mkr = Master_11_MataKuliahRegister::create([
                        'tahun_akademik_awal' => $validated['tahun_mulai'],
                        'tahun_akademik_akhir' => $validated['tahun_selesai'],
                        'semester' => $validated['semester'],
                        'jenis' => $validated['jenis'],
                        '07_MASTER_mata_kuliah_id' => $validated['id_mata_kuliah']
                    ]);

                    $mkr->dosen()->attach($validated['dosen_pengampu']);
                    $mkr->indikatorKinerja()->attach($validated['indikator_kinerja']);
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

    public function show($tahun_kurikulum, $id)
    {
        if (request()->ajax()) {
            $mkr = Master_11_MataKuliahRegister::with('indikatorKinerja', 'dosen')->find($id);
            $ik = $mkr->indikatorKinerja->pluck('id')->toArray();
            $dosen = $mkr->dosen->pluck('id')->toArray();

            return response()->json([
                'mkr' => $mkr,
                'indikator_kinerja' => $ik,
                'dosen' => $dosen,
            ]);
        }
    }

    public function update(MataKuliahRegisterRequest $request, $tahun_kurikulum, $id)
    {
        if ($request->ajax()) {
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

            $mkr = Master_11_MataKuliahRegister::find($id);

            try {
                DB::transaction(function () use ($validated, $mkr) {
                    $mkr->update([
                        'tahun_akademik_awal' => $validated['tahun_mulai'],
                        'tahun_akademik_akhir' => $validated['tahun_selesai'],
                        'semester' => $validated['semester'],
                        'jenis' => $validated['jenis']
                    ]);

                    $mkr->dosen()->sync($validated['dosen_pengampu']);
                    $mkr->indikatorKinerja()->sync($validated['indikator_kinerja']);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil diubah',
            ], 200);
        }
    }
}
