<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_11_MataKuliahRegister;
use Illuminate\Http\Request;
use App\Http\Requests\CapaianPembelajaranLulusanStoreRequest;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_09_IndikatorKinerja;

class CapaianPembelajaranLulusanController extends Controller
{
    protected $validation;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    protected $indikatorKinerja;
    protected $mataKuliah;
    protected $dataIndikatorKinerja = [];

    public function __construct()
    {
        $this->validation = new CapaianPembelajaranLulusanStoreRequest();
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->indikatorKinerja = new Master_09_IndikatorKinerja();
        $this->mataKuliah = new Master_07_MataKuliah(); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($kurikulum)
    {   
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        
        $dataCPL = $this->getDataCPL($this->kurikulum->capaianPembelajaranLulusan->sortBy('kode'));
        
        return view('kaprodi.cpl.index', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'data_cpl' => $dataCPL,
            'kurikulum' => $this->kurikulum,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CapaianPembelajaranLulusanStoreRequest $request, $kurikulum)
    {
        $validator = $request->validated();

        $kodeDomain = $this->kodeCP($request->input('domain'));
        // dd($request->input('domain'));

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $dataCpl = Master_08_CapaianPembelajaranLulusan::where('kode', 'like', '%' . $kodeDomain . '%')
            ->where('03_MASTER_kurikulum_id', $this->kurikulum->id)
            ->get()
            ->count();

        $cpl = new Master_08_CapaianPembelajaranLulusan([
            'kode' => $kodeDomain . "-" . ($dataCpl + 1),
            'domain' => $request->input('domain'),
            'deskripsi' => $request->input('deskripsi'),
            '03_MASTER_kurikulum_id' => $this->kurikulum->id
        ]);

        if ($cpl->save()) {
            return redirect()->route('kaprodi.cpl.index', compact('kurikulum'));
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kurikulum, $cpl)
    {
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $cpl = Master_08_CapaianPembelajaranLulusan::where('kode', $cpl)->with('indikatorKinerja.mataKuliahRegister.mataKuliah')->first();
        $dataCPL = $this->getDataCPL($this->kurikulum->capaianPembelajaranLulusan->sortBy('kode'));
        
        return view('kaprodi.cpl.show', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_cpl' => $dataCPL,
            'cpl' => $cpl,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kurikulum, $cpl)
    {
        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);
        $cpl = Master_08_CapaianPembelajaranLulusan::where('kode', $cpl)->first();
        return view('kaprodi.cpl.edit', [
            'title' => 'CPL',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'data_cpl' => $this->kurikulum->capaianPembelajaranLulusan,
            'cpl' => $cpl,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CapaianPembelajaranLulusanStoreRequest $request, $kurikulum, $cpl)
    {
        $validator = $request->validated();

        $this->kurikulum = $this->kurikulum->getDataIfKurikulumProgramStudiIsExist($this->kaprodiNip, $kurikulum);

        $dataCPL = Master_08_CapaianPembelajaranLulusan::where('kode', $cpl)
                ->where('03_MASTER_kurikulum_id', $this->kurikulum->id)->first();

        $dataCPL->deskripsi = $request->input('deskripsi');
        $dataCPL->updated_at = date('Y-m-d H:i:s');

        if ($dataCPL->save()) {
            return redirect()->route('kaprodi.cpl.show', compact('kurikulum', 'cpl'));
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
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
