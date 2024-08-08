<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Imports\CapaianPembelajaranLulusanImport;
use App\Http\Requests\CapaianPembelajaranLulusanRequest;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Auth;
use App\Models\Master_03_Kurikulum;
use Maatwebsite\Excel\Facades\Excel;

class CapaianPembelajaranLulusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
        $data_cpl = Master_08_CapaianPembelajaranLulusan::with('indikatorKinerja.rubrik')
            ->where('03_MASTER_kurikulum_id', $kurikulum->id);

        if (request('domain')) {
            switch (request('domain')) {
                case 'sikap':
                    $data_cpl->sikap();
                    break;
                case 'pengetahuan':
                    $data_cpl->pengetahuan();
                    break;
                case 'keterampilan-umum':
                    $data_cpl->keterampilanUmum();
                    break;
                case 'keterampilan-khusus':
                    $data_cpl->keterampilanKhusus();
                    break;
            }
        }

        return view('kaprodi.cpl.index', [
            'title' => 'Capaian Pembelajaran',
            'kurikulum' => $kurikulum,
            'data_cpl' => $data_cpl->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CapaianPembelajaranLulusanRequest $request, $tahun_kurikulum)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $kode_domain = $this->kodeCP($validated['domain']);

            $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);
            $data_cpl = Master_08_CapaianPembelajaranLulusan::where('kode', 'like', '%' . $kode_domain . '%')
                ->where('03_MASTER_kurikulum_id', $kurikulum->id)
                ->get()
                ->count();

            try {
                Master_08_CapaianPembelajaranLulusan::create([
                    'kode' => $kode_domain . "-" . ($data_cpl + 1),
                    'domain' => $validated['domain'],
                    'deskripsi' => $validated['deskripsi'],
                    '03_MASTER_kurikulum_id' => $kurikulum->id
                ]);
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
        $cpl = Master_08_CapaianPembelajaranLulusan::with(['indikatorKinerja.rubrik', 'indikatorKinerja.mataKuliahRegister.mataKuliah'])
            ->find($id);

        $pemetaan_mk = collect();
        foreach ($cpl->indikatorKinerja as $ik) {
            foreach($ik->mataKuliahRegister as $mkr) {
                $kode_mk = $mkr->mataKuliah->kode;

                if (!$pemetaan_mk->has($kode_mk)) {
                    $pemetaan_mk->put($kode_mk, [
                        'nama' => $mkr->mataKuliah->nama,
                        'indikator_kinerja' => collect(),
                        'tujuan_pembelajaran' => collect()
                    ]);
                }

                if (!$pemetaan_mk[$kode_mk]['indikator_kinerja']->has($ik->kode)) {
                    $pemetaan_mk[$kode_mk]['indikator_kinerja']->put($ik->kode, [
                        'deskripsi' => $ik->deskripsi
                    ]);
                }

                foreach ($mkr->tujuanPembelajaran as $tp) {
                    if (!$pemetaan_mk[$kode_mk]['tujuan_pembelajaran']->has($tp->kode)) {
                        $pemetaan_mk[$kode_mk]['tujuan_pembelajaran']->put($tp->kode, [
                            'deskripsi' => $tp->deskripsi
                        ]);
                    }
                }

            }
        }

        return view('kaprodi.cpl.show', [
            'title' => 'Capaian Pembelajaran',
            'kurikulum' => $kurikulum,
            'cpl' => $cpl,
            'pemetaan_mk' => $pemetaan_mk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CapaianPembelajaranLulusanRequest $request, $tahun_kurikulum, $id)
    {
        if ($request->ajax()) {
            $validated = $request->validated();

            $cpl = Master_08_CapaianPembelajaranLulusan::find($id);

            try {
                $cpl->update($validated);
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

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_CPL.xlsx');

        return response()->download($file_path);
    }

    public function import($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        Excel::import(new CapaianPembelajaranLulusanImport($kurikulum->id), request()->file('formFileCpl'));

        return redirect(route('kaprodi.cpl.index', ['kurikulum' => $tahun_kurikulum]))->with('success', 'All good!');
    }

    // Fungsi ini digunakan untuk mengambil inisial dari domain CPL
    private function kodeCP($domain)
    {
        $wordCount = str_word_count($domain);
        $word = explode(" ", $domain);
        $kode = "";
        foreach ($word as $w) {
            $kode .= strtoupper(substr($w, 0, 1));
        }
        return $this->checkIfWordLessThanTwo($kode);
    }

    /*
        Fungsi ini digunakan untuk mengembalikan apabila hasil inisial
        dari domain CPL kurang dari 2 huruf
    */
    private function checkIfWordLessThanTwo($kode){
        if($kode === "P"){
            $kode = $kode . $kode;
        } else if ($kode === "S") {
            $kode = $kode . "P";
        }
        return $kode;
    }
}
