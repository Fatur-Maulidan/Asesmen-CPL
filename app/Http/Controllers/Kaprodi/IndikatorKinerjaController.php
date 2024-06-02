<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndikatorKinerja;
use App\Models\CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IndikatorKinerjaStoreRequest;

class IndikatorKinerjaController extends Controller
{
    protected $validator;
    
    public function __construct()
    {
        $this->validator = new IndikatorKinerjaStoreRequest();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $pemetaanIkCp = [];

        $cpInduk = CapaianPembelajaranLulusan::whereHas('kurikulum', function($query) use ($kurikulum) {
            $query->where('tahun', $kurikulum);
        })
        ->get()
        ->sortBy('kode');

        $dataIk = IndikatorKinerja::get();
        foreach($dataIk as $ik){
            $pemetaanIkCp[] = IndikatorKinerja::where('id',$ik->id)->whereHas('capaianPembelajaranLulusan', function($query) use ($ik) {
                $query->where('08_master_indikator_kinerja_id', $ik->id);
            })->get()->first();
        };

        return view('kaprodi.ik.index', [
            'title' => 'Indikator Kinerja',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'cpInduk' => $cpInduk,
            'dataIk' => $pemetaanIkCp
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
        $kaprodiNip = '199301062019031017';

        $validation = Validator::make(
            $request->all(),
            $this->validator->rules(),
            $this->validator->messages()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $dataIK = IndikatorKinerja::get()->count();

        $cariCp = CapaianPembelajaranLulusan::where('kode', $request->input('domain'))
        ->whereHas('kurikulum', function($query) use ($kurikulum, $kaprodiNip) {
            $query->where('tahun', $kurikulum)
            ->whereHas('programStudi', function($query) use ($kaprodiNip) {
                $query->where('koordinator_nip', $kaprodiNip);
            });
        })
        ->with('kurikulum.programStudi.dosen')
        ->first();

        dd($cpl = $request->input('cpInduk'));

        $indikatorKinerja = new IndikatorKinerja([
            'kode' => "IK-".($dataIK + 1),
            'deskripsi' => $request->input('deskripsi'),
            'bobot' => $request->input('bobot')
        ]);
        
        if($indikatorKinerja->save()){
            return redirect()->route('kaprodi.ik.index', ['kurikulum' => $request->input('kurikulum')])->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kaprodi.ik.index', ['kurikulum' => $request->input('kurikulum')])->with('error', 'Data gagal ditambahkan');
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
        return view('kaprodi.ik.show', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'ik' => [
                'kode' => 'SS-1.1'
            ]
        ]);
    }

    public function detail($kurikulum, $id)
    {
        return view('kaprodi.ik.detail', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'ik' => [
                'kode' => 'SS-1.1'
            ]
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
        return view('kaprodi.ik.edit', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'ik' => [
                'kode' => 'SS-1.1'
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
    public function update(Request $request, $id)
    {
        //
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
}
