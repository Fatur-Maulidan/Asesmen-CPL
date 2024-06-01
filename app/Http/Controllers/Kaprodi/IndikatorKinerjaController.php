<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranLulusan;
use App\Models\IndikatorKinerja;
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
        $cpInduk = CapaianPembelajaranLulusan::all()->sortBy('kode');

        return view('kaprodi.ik.index', [
            'title' => 'Indikator Kinerja',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'cpInduk' => $cpInduk
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            $this->validator->rules(),
            $this->validator->messages()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $dataIK = IndikatorKinerja::get()->count();

        $indikatorKinerja = new IndikatorKinerja([
            'kode' => "IK-".($dataIK + 1),
            'indikator' => $request->input('indikator'),
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
