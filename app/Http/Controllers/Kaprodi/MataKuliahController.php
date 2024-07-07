<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Imports\MataKuliahImport;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_11_MataKuliahRegister;
use App\Models\Master_12_PetaIkMk;
use Illuminate\Http\Request;
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
        $mata_kuliah = Master_07_MataKuliah::where('03_MASTER_kurikulum_id', $kurikulum->id)->get();

        return view('kaprodi.mk.index', [
            'title' => 'Mata Kuliah',
            'kurikulum' => $kurikulum,
            'mata_kuliah' => $mata_kuliah->sortBy('kode', SORT_NATURAL),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MataKuliahRequest $request, $tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        if ($request->ajax()) {
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
    public function show($kurikulum, $kode)
    {
        $dataIkChecked = collect();
        $mataKuliah = new Master_07_MataKuliah;

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $daftarMataKuliah = Master_07_MataKuliah::where('03_MASTER_kurikulum_id',$this->kurikulum->id)->get();
        $mataKuliah = $mataKuliah->getMataKuliahByKodeAndKurikulum($kode, $this->kurikulum->id);

        foreach($mataKuliah->mataKuliahRegister as $mkr) {
            foreach($mkr->indikatorKinerja as $ik){
                if(!$dataIkChecked->contains($ik)){
                    $dataIkChecked->push($ik);
                }
            }
        }

        // dd($dataIkChecked->unique('kode')->pluck('kode')->toArray());
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);
        return view('kaprodi.mk.show', [
            'title' => 'Mata Kuliah',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'daftar_mata_kuliah' => $daftarMataKuliah,
            'detail_mata_kuliah' => $mataKuliah,
            'indikator_kinerja' => $this->indikatorKinerja,
            'selected_data_ik' => $dataIkChecked->unique('kode')->pluck('kode')->toArray()
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

    public function pemetaan(Request $request, $kurikulum, $id)
    {
        $indikatorKinerja = new Master_09_IndikatorKinerja();
        $jenis = "Teori";
        $mataKuliah = Master_07_MataKuliah::find($id);
        $mataKuliahRegister = Master_11_MataKuliahRegister::where('07_MASTER_mata_kuliah_id', $mataKuliah->id)
            ->where('jenis', $jenis)
            ->first();
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);

        foreach($request->input('checkbox') as $ik){
            $petaIkMk[] = [
                '11_MASTER_mk_register_id' => $mataKuliahRegister->id,
                '09_MASTER_indikator_kinerja_id' => $indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id,'', $ik)->first()->id,
            ];
        }
        if(Master_12_PetaIkMk::insert($petaIkMk)){
            return redirect()->route('kaprodi.mata-kuliah.show', [
                'kurikulum' => $kurikulum,
                'mata_kuliah' => $mataKuliah->kode
            ])->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('kaprodi.mata-kuliah.show', [
                'kurikulum'=> $kurikulum,
                'mata_kuliah'=> $mataKuliah->kode
            ])->with('error', 'Data gagal disimpan');
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
