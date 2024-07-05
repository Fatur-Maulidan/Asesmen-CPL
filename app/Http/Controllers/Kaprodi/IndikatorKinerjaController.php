<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PetaCpIk;
use Illuminate\Http\Request;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IndikatorKinerjaRequest;
use App\Models\Master_10_Rubrik;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;

class IndikatorKinerjaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(IndikatorKinerjaRequest $request, $tahun_kurikulum)
    {
        if ($request->ajax()) {
            $validated = $request->validated();

            $cpl = Master_08_CapaianPembelajaranLulusan::with('indikatorKinerja')
                ->find($validated['id_cpl']);

            try {
                DB::transaction(function () use ($tahun_kurikulum, $cpl, $validated) {
                    $ik = Master_09_IndikatorKinerja::create([
                        'kode' => $validated['cp_induk'] . '.' . (count($cpl->indikatorKinerja) + 1),
                        'deskripsi' => $validated['deskripsi_ik'],
                        '08_MASTER_capaian_pembelajaran_lulusan_id' => $validated['id_cpl'],
                    ]);

                    foreach ($validated['rubrik'] as $index => $rubrik) {
                        Master_10_Rubrik::create([
                            'urutan' => $index + 1,
                            'deskripsi' => $rubrik,
                            '09_MASTER_indikator_kinerja_id' => $ik->id,
                        ]);
                    }
                });
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil ditambahkan.',
            ], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IndikatorKinerjaRequest $request, $tahun_kurikulum, $id)
    {
        if ($request->ajax()) {
            $validated = $request->validated();

            $ik = Master_09_IndikatorKinerja::find($id);

            try {
                DB::transaction(function () use ($ik, $validated) {
                    $ik->update([
                        'deskripsi' => $validated['deskripsi_ik'],
                    ]);

                    foreach ($validated['rubrik'] as $index => $rubrik) {
                        DB::table('10_MASTER_rubrik')
                            ->where('urutan', $index + 1)
                            ->where('09_MASTER_indikator_kinerja_id', $ik->id)
                            ->update(['deskripsi' => $rubrik]);
                    }
                });
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil disimpan.',
            ]);
        }
    }

    public function detail($kurikulum, $ik)
    {
        $dataIk = new Master_09_IndikatorKinerja();

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, $ik);

        $dataIk = $dataIk->getDataIndikatorKinerja($this->kurikulum->id);

        return view('kaprodi.ik.detail', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'ik' => $this->indikatorKinerja[0],
            'dataCpl' => $this->indikatorKinerja[0]->capaianPembelajaranLulusan,
            'dataIk' => $dataIk,
        ]);
    }

    // Substring Kode yang diambil hanya 2 huruf diawal
    private function subStringKodeCpl($kode) {
        return substr($kode, 0, 2);
    }

    private function filterDataByKode($dataCpl, $kode) {
        $filteredData = $dataCpl->filter(function ($value) use ($kode) {
            return strpos($value->kode, $kode) === 0;
        });

        return $filteredData;
    }
}
