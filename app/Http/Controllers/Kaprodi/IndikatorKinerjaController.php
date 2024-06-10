<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\PetaCpIk;
use Illuminate\Http\Request;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_08_CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IndikatorKinerjaStoreRequest;
use App\Models\Master_10_Rubrik;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;


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
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->capaianPembelajaranLulusan = new Master_08_CapaianPembelajaranLulusan();
        $this->indikatorKinerja = new Master_09_IndikatorKinerja();
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

        $indikatorKinerja = new Master_09_IndikatorKinerja([
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
                $rubrik = new Master_10_Rubrik([
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
        $dataIk = new Master_09_IndikatorKinerja();

        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, $ik);
        $dataIk = $dataIk->getDataIndikatorKinerja($this->kurikulum->id);

        return view('kaprodi.ik.show', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'dataIk' => $dataIk,
            'ik' => $this->indikatorKinerja[0]
        ]);
    }

    public function detail($kurikulum, $ik)
    {
        $dataIk = new Master_09_IndikatorKinerja();

        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, $ik);

        $dataIk = $dataIk->getDataIndikatorKinerja($this->kurikulum->id);

        return view('kaprodi.ik.detail', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'ik' => $this->indikatorKinerja[0],
            'dataCpl' => $this->indikatorKinerja[0]->capaianPembelajaranLulusan,
            'dataIk' => $dataIk,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kurikulum, $ik)
    {
        $dataIk = new Master_09_IndikatorKinerja();

        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);
        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id, $ik);

        $dataIk = $dataIk->getDataIndikatorKinerja($this->kurikulum->id);
        $filteredDataCpl = $this->filterDataByKode(
            $this->kurikulum->cpl,
            $this->subStringKodeCpl($this->indikatorKinerja[0]->capaianPembelajaranLulusan[0]->kode)
        );

        return view('kaprodi.ik.edit', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'dataIk' => $dataIk,
            'filteredDataCpl' => $filteredDataCpl,
            'subStrCpl' => $this->subStringKodeCpl($this->indikatorKinerja[0]->capaianPembelajaranLulusan[0]->kode),
            'ik' => $this->indikatorKinerja[0],
            'dataCpl' => $this->kurikulum->cpl,
            'domainCpl' => ['Pengetahuan', 'Sikap', 'Keterampilan Umum', 'Keterampilan Khusus'],
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
        $validation = Validator::make(
            $request->all(),
            $this->validator->rules(),
            $this->validator->messages()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $dataIk = Master_09_IndikatorKinerja::where('id',$id)->first();

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
        Master_09_IndikatorKinerja::destroy($id);
        return redirect()->route('kaprodi.ik.index')->with('success', 'Data berhasil dihapus');
    }

    // Substring Kode yang diambil hanya 2 huruf diawal
    private function subStringKodeCpl($kode) {
        return substr($kode, 0, 2);
    }

    private function filterDataByKode($dataCpl, $kode) {
        $filteredData = $dataCpl->filter(function ($value) use ($kode) {
            return strpos($value->kode, $kode) === 0;
        });

        return $filteredData;
    }
}
