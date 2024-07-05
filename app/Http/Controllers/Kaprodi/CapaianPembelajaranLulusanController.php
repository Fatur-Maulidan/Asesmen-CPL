<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Imports\CapaianPembelajaranLulusanImport;
use App\Imports\JurusanImport;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_11_MataKuliahRegister;
use Illuminate\Http\Request;
use App\Http\Requests\CapaianPembelajaranLulusanRequest;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_09_IndikatorKinerja;
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
            ->where('03_MASTER_kurikulum_id', $kurikulum->id)
            ->get();

        return view('kaprodi.cpl.index', [
            'title' => 'Capaian Pembelajaran',
            'kurikulum' => $kurikulum,
            'data_cpl' => $data_cpl,
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
    public function show($kurikulum, $cpl)
    {
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $cpl = Master_08_CapaianPembelajaranLulusan::where('kode', $cpl)->with('indikatorKinerja.mataKuliahRegister.mataKuliah')->first();
        $dataCPL = $this->getDataCPL($this->kurikulum->capaianPembelajaranLulusan->sortBy('kode'));

        $dataMk = collect();
        foreach ($cpl->indikatorKinerja as $ik) {
            foreach($ik->mataKuliahRegister as $mkr) {
                $namaMataKuliah = $mkr->mataKuliah->nama;
                if (!$dataMk->has($namaMataKuliah)) {
                    $dataMk->put($namaMataKuliah,[
                        'mataKuliah' => $mkr->mataKuliah,
                        'indikatorKinerja' => collect()
                    ]);
                }
                if (!$dataMk[$namaMataKuliah]['indikatorKinerja']->contains('id', $ik->id)) {
                    $dataMk[$namaMataKuliah]['indikatorKinerja']->push([
                        'id' => $ik->id,
                        'indikatorKinerja' => $ik,
                        'tujuanPembelajaran' => collect()
                    ]);
                }

                $index = $dataMk[$namaMataKuliah]['indikatorKinerja']->search(function ($item) use ($ik) {
                    return $item['id'] === $ik->id;
                });

                foreach ($mkr->tujuanPembelajaran as $tp) {
                    if (!$dataMk[$namaMataKuliah]['indikatorKinerja'][$index]['tujuanPembelajaran']->contains('kode', $tp->kode)) {
                        $dataMk[$namaMataKuliah]['indikatorKinerja'][$index]['tujuanPembelajaran']->push([
                            'kode' => $tp->kode,
                            'deskripsi' => $tp->deskripsi
                        ]);
                    }
                }
            }
        }
        return view('kaprodi.cpl.show', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_cpl' => $dataCPL,
            'cpl' => $cpl,
            'data_mk' => $dataMk
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

    /*
        Fungsi ini digunakan untuk mengambil data CPL dan mengubah struktur data CPL
        yang awalnya CPL -> IK -> MKRegister -> MK
        menjadi CPL -> MKRegister -> MK -> IK
    */
    private function getDataCPL($dataCpl) {
        $dataCPL = collect();

        foreach ($dataCpl as $cpl) {
            $cplData = collect([
                'kode' => $cpl->kode,
                'domain' => $cpl->domain,
                'deskripsi' => $cpl->deskripsi,
                'mataKuliahRegister' => collect(),
                'indikatorKinerjaBelumDipetakan' => collect()
            ]);

            foreach ($cpl->indikatorKinerja as $ik) {
                $mapped = false;
                foreach ($ik->mataKuliahRegister as $mkr) {
                    $mapped = true;
                    $mataKuliahNama = $mkr->mataKuliah->nama;
                    if (!isset($cplData['mataKuliahRegister'][$mataKuliahNama])) {
                        $cplData['mataKuliahRegister'][$mataKuliahNama] = [
                            'mataKuliah' => $mkr->mataKuliah,
                            'indikatorKinerja' => collect()
                        ];
                    }
                    if(!$cplData['mataKuliahRegister'][$mataKuliahNama]['indikatorKinerja']->contains($ik))
                        $cplData['mataKuliahRegister'][$mataKuliahNama]['indikatorKinerja']->push($ik);
                }
                if (!$mapped) {
                    $cplData['indikatorKinerjaBelumDipetakan']->push($ik);
                }
            }
            $dataCPL->push($cplData);
        }
        return $dataCPL;
    }
}
