<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CapaianPembelajaranLulusanStoreRequest;
use App\Models\CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;

class CapaianPembelajaranLulusanController extends Controller
{
    protected $validation;
    public function __construct() {
        $this->validation = new CapaianPembelajaranLulusanStoreRequest();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $dataCPL = CapaianPembelajaranLulusan::all()->sortBy('kode');

            if (request()->expectsJson()) {
            return response()->json([
                'kurikulum' => $kurikulum,
                'dataCPL' => $dataCPL
            ]);
        }

        return view('kaprodi.cpl.index', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'dataCPL' => $dataCPL,
            'kurikulum' => $kurikulum
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
        
        $dataCPL = CapaianPembelajaranLulusan::where('kode', 'like', '%' . $kodeDomain . '%')->get()->count();

        $cpl = new CapaianPembelajaranLulusan([
            'kode' => $kodeDomain . "-" . ($dataCPL + 1),
            'domain' => $request->input('domain'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'tanggal_pembaruan' => date('Y-m-d H:i:s')
        ]);

        if($cpl->save()){
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
        $dataCPL = CapaianPembelajaranLulusan::all()->sortBy('kode');
        $CPL = CapaianPembelajaranLulusan::where('kode',$id)->first();

        // if (request()->expectsJson()) {
        //     return response()->json([
        //         'kurikulum' => $kurikulum,
        //         'dataCPL' => $dataCPL,
        //         'cpl' => $CPL,
        //     ]);
        // }

        return view('kaprodi.cpl.show', [
            'title' => 'Capaian Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'dataCPL' => $dataCPL,
            'cpl' => $CPL,
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
        $validator = Validator::make(
            $request->all(),
            $this->validation->rules(),
            $this->validation->message()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataCPL = CapaianPembelajaranLulusan::where('kode', $cpl)->first();
        $dataCPL->deskripsi = $request->input('deskripsi');
        $dataCPL->tanggal_pembaruan = date('Y-m-d H:i:s');

        if($dataCPL->save()){
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

    private function kodeCP($domain){
        $wordCount = str_word_count($domain);
        $word = explode(" ", $domain);
        $kode = "";
        foreach($word as $w){
            $kode .= strtoupper(substr($w, 0, 1));
        }
        return $this->checkIfWordMoreThanTwo($kode, $wordCount);
    }

    private function checkIfWordMoreThanTwo($kode, $wordCount){
        if($wordCount < 2){
            $kode = $kode . $kode;
        }
        return $kode;
    }
}
