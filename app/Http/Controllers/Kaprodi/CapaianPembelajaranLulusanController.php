<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CapaianPembelajaranLulusanStoreRequest;
use App\Models\CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Models\Kurikulum;
use App\Models\Dosen;

class CapaianPembelajaranLulusanController extends Controller
{
    protected $validation;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;

    public function __construct()
    {
        $this->validation = new CapaianPembelajaranLulusanStoreRequest();
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Dosen();
        $this->kurikulum = new Kurikulum();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        return view('kaprodi.cpl.index', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'dataCPL' => $this->kurikulum->cpl->sortBy('kode'),
            'kurikulum' => $this->kurikulum
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kurikulum)
    {
        $validator = Validator::make(
            $request->all(),
            $this->validation->rules(),
            $this->validation->message()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kodeDomain = $this->kodeCP($request->input('domain'));

        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        $dataCPL = CapaianPembelajaranLulusan::where('kode', 'like', '%' . $kodeDomain . '%')
            ->where('03_MASTER_kurikulum_id', $this->kurikulum->id)
            ->get()
            ->count();

        $cpl = new CapaianPembelajaranLulusan([
            'kode' => $kodeDomain . "-" . ($dataCPL + 1),
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
    public function show($kurikulum, $id)
    {
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        $cpl = CapaianPembelajaranLulusan::where('kode', $id)->first();

        return view('kaprodi.cpl.show', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'dataCPL' => $this->kurikulum->cpl,
            'cpl' => $cpl,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kurikulum, $id)
    {
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->id, $kurikulum);

        return view('kaprodi.cpl.edit', [
            'title' => 'CPL',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'cpl' => [
                'kode' => 'SS-1'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kurikulum, $cpl)
    {
        $kaprodiNip = '199301062019031017';
        
        $validator = Validator::make(
            $request->all(),
            $this->validation->rules(),
            $this->validation->message()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        $dataCPL = CapaianPembelajaranLulusan::where('kode', $cpl)
                ->where('03_MASTER_kurikulum_id', $this->kurikulum->id)->first();
        
        $dataCPL->deskripsi = $request->input('deskripsi');
        $dataCPL->updated_at = date('Y-m-d H:i:s');

        if ($dataCPL->save()) {
            return redirect()->route('kaprodi.cpl.show', compact('kurikulum', 'cpl'));
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data');
        }
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

    private function kodeCP($domain)
    {
        $wordCount = str_word_count($domain);
        $word = explode(" ", $domain);
        $kode = "";
        foreach ($word as $w) {
            $kode .= strtoupper(substr($w, 0, 1));
        }
        return $this->checkIfWordLessThanTwo($kode, $wordCount);
    }

    private function checkIfWordLessThanTwo($kode, $wordCount){
        if($wordCount < 2){
            $kode = $kode . $kode;
        }
        return $kode;
    }
}
