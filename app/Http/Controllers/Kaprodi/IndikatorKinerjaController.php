<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PetaCpIk;
use Illuminate\Http\Request;
use App\Models\IndikatorKinerja;
use App\Models\CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IndikatorKinerjaStoreRequest;
use App\Models\Rubrik;
use App\Models\Dosen;
use App\Models\Kurikulum;


class IndikatorKinerjaController extends Controller
{
    protected $validator;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    protected $capaianPembelajaranLulusan;
    protected $indikatorKinerja;
    
    public function __construct()
    {
        $this->validator = new IndikatorKinerjaStoreRequest();
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Dosen();
        $this->kurikulum = new Kurikulum();
        $this->capaianPembelajaranLulusan = new CapaianPembelajaranLulusan();
        $this->indikatorKinerja = new IndikatorKinerja();
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
        
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);

        return view('kaprodi.ik.index', [
            'title' => 'Indikator Kinerja',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'dataIk' => $this->indikatorKinerja
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
        $levelKemampuan = rubrik();

        $validation = Validator::make(
            $request->all(),
            $this->validator->rules(),
            $this->validator->messages()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }
        
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);
        $this->capaianPembelajaranLulusan = $this->capaianPembelajaranLulusan
                                                ->getCplIdByKurikulum($request->input('cpInduk'),$this->kurikulum->id);
        
        $indikatorKinerja = new IndikatorKinerja([
            'kode' => "IK-".(count($this->indikatorKinerja) + 1),
            'deskripsi' => $request->input('deskripsi'),
            'bobot' => $request->input('bobot')
        ]);

        if($indikatorKinerja->save()){
            $cpIk = new PetaCpIk([
                '07_MASTER_capaian_pembelajaran_lulusan_id' => $this->capaianPembelajaranLulusan->id,
                '08_MASTER_indikator_kinerja_id' => $indikatorKinerja->id,
            ]);
            
            $cpIk->save();

            for($i = 0; $i < 5; $i++){
                $rubrik = new Rubrik([
                    'urutan' => $i+1,
                    'level_kemampuan' => $levelKemampuan[$i],
                    'deskripsi' => $request->input('rubrik-'.($i)),
                    '08_MASTER_indikator_kinerja_id' => $indikatorKinerja->id
                ]);

                $rubrik->save();
            }
            return redirect()->route('kaprodi.ik.index', ['kurikulum' => $kurikulum])->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('kaprodi.ik.index', ['kurikulum' => $kurikulum])->with('error', 'Data gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kurikulum, $ik)
    {
        $dataIk = new IndikatorKinerja();
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, $ik);
        $dataIk = $dataIk->getDataIndikatorKinerja($this->kurikulum->id);
            
        return view('kaprodi.ik.show', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'dataIk' => $dataIk,
            'ik' => $this->indikatorKinerja[0]
        ]);
    }

    public function detail($kurikulum, $ik)
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
    public function update(Request $request, $kurikulum, $id)
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

        $dataIk = IndikatorKinerja::where('id',$id)->first();

        $dataIk->deskripsi = $request->input('deskripsi');
        
        if($dataIk->save()){
            return redirect()->route('kaprodi.ik.show', ['kurikulum' => $kurikulum, 'ik' => $dataIk->kode])->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('kaprodi.ik.show', ['kurikulum' => $kurikulum, 'ik' => $dataIk->kode])->with('error', 'Data gagal diubah');
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
        IndikatorKinerja::destroy($id);
        return redirect()->route('kaprodi.ik.index')->with('success', 'Data berhasil dihapus');
    }
}
