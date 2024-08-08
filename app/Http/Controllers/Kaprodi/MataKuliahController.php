<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Imports\MataKuliahImport;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
        $mata_kuliah = Master_07_MataKuliah::with('mataKuliahRegister.indikatorKinerja.capaianPembelajaranLulusan')
            ->where('03_MASTER_kurikulum_id', $kurikulum->id)->get();

        $cp_mata_kuliah = collect();

        for ($i = 0; $i < $mata_kuliah->count(); $i++) {
            if ($mata_kuliah[$i]->mataKuliahRegister->isNotEmpty()) {
                if (!$cp_mata_kuliah->has($mata_kuliah[$i]->kode)) {
                    $cp_mata_kuliah->put($mata_kuliah[$i]->kode, collect());
                }

                foreach ($mata_kuliah[$i]->mataKuliahRegister as $mkr) {
                    foreach ($mkr->indikatorKinerja as $ik) {
                        $cp_exists = $cp_mata_kuliah->get($mata_kuliah[$i]->kode)->contains(function ($value) use ($ik) {
                            return $value['kode'] === $ik->capaianPembelajaranLulusan->kode;
                        });

                        if (!$cp_exists) {
                            $cp_mata_kuliah->get($mata_kuliah[$i]->kode)->push([
                                'kode' => $ik->capaianPembelajaranLulusan->kode,
                                'deskripsi' => $ik->capaianPembelajaranLulusan->deskripsi,
                            ]);
                        }
                    }
                }
            }
        }

        return view('kaprodi.mk.index', [
            'title' => 'Mata Kuliah',
            'kurikulum' => $kurikulum,
            'mata_kuliah' => $mata_kuliah->sortBy('kode', SORT_NATURAL),
            'cp_mata_kuliah' => $cp_mata_kuliah,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MataKuliahRequest $request, $tahun_kurikulum)
    {
        if ($request->ajax()) {
            $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
            $validated = $request->validated();
            $validated['03_MASTER_kurikulum_id'] = $kurikulum->id;

            try {
                Master_07_MataKuliah::create($validated);
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

    /**
     * Display the specified resource.
     */
    public function show($tahun_kurikulum, $id)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
        $mata_kuliah = Master_07_MataKuliah::with('mataKuliahRegister')->find($id);
        $dosen = Master_04_Dosen::where('01_MASTER_jurusan_id', Auth::user()->jurusan->id)->get();
        $cpl = Master_08_CapaianPembelajaranLulusan::with('indikatorKinerja')
            ->where('03_MASTER_kurikulum_id', $kurikulum->id)->get();

        return view('kaprodi.mk.show', [
            'title' => 'Detail Mata Kuliah',
            'kurikulum' => $kurikulum,
            'mata_kuliah' => $mata_kuliah,
            'dosen' => $dosen,
            'cpl' => $cpl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MataKuliahRequest $request, $tahun_kurikulum, $id)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $mata_kuliah = Master_07_MataKuliah::find($id);

            try {
                $mata_kuliah->update($validated);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil diubah.',
            ], 200);
        }
    }

    public function downloadTemplate($tahun_kurikulum)
    {
        $file_path = public_path('files/templates/Template_Mata_Kuliah.xlsx');

        return response()->download($file_path);
    }

    public function import($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        Excel::import(new MataKuliahImport($kurikulum->id), request()->file('formFile'));

        return redirect()->back();
    }
}
