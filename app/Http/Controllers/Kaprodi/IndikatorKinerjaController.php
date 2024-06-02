<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndikatorKinerja;
use App\Models\CapaianPembelajaranLulusan;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\IndikatorKinerjaStoreRequest;
use App\Models\PetaCpIk;
use App\Models\Rubrik;

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
        $kaprodiNip = '199301062019031017';
        $pemetaanIkCp = [];

        $cpInduk = CapaianPembelajaranLulusan::whereHas('kurikulum', function($query) use ($kurikulum) {
            $query->where('tahun', $kurikulum);
        })
        ->get()
        ->sortBy('kode');

        
        $dataIk = IndikatorKinerja::get();
        foreach($dataIk as $ik){
            // $data = IndikatorKinerja::leftJoin('13_master_peta_cp_ik as cpik', '08_master_indikator_kinerja.id', '=', 'cpik.08_MASTER_indikator_kinerja_id')
            // ->select('08_master_indikator_kinerja.*', 'cpik.*')
            // ->get();

            $pemetaanIkCp[] = IndikatorKinerja::where('id',$ik->id)->whereHas('capaianPembelajaranLulusan', function($query) use ($ik, $kurikulum, $kaprodiNip) {
                $query->where('08_master_indikator_kinerja_id', $ik->id)
                ->whereHas('kurikulum', function($query) use ($kurikulum, $kaprodiNip) {
                    $query->where('tahun', $kurikulum)
                    ->whereHas('programStudi', function($query) use ($kaprodiNip) {
                        $query->where('koordinator_nip', $kaprodiNip);
                    });
                });
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
        $level_kemampuan = rubrik();

        $validation = Validator::make(
            $request->all(),
            $this->validator->rules(),
            $this->validator->messages()
        );

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $dataIK = IndikatorKinerja::whereHas('capaianPembelajaranLulusan', 
        function($query) use ($kaprodiNip, $kurikulum) {
            $query->whereHas('kurikulum', function($query) use ($kurikulum, $kaprodiNip) {
                $query->where('tahun', $kurikulum)
                ->whereHas('programStudi', function($query) use ($kaprodiNip) {
                    $query->where('koordinator_nip', $kaprodiNip);
                });
            });
        })->get()->count();

        $cariCp = CapaianPembelajaranLulusan::where('kode', $request->input('cpInduk'))
        ->whereHas('kurikulum', function($query) use ($kurikulum, $kaprodiNip) {
            $query->where('tahun', $kurikulum)
            ->whereHas('programStudi', function($query) use ($kaprodiNip) {
                $query->where('koordinator_nip', $kaprodiNip);
            });
        })
        ->with('kurikulum.programStudi.dosen')
        ->first();

        $indikatorKinerja = new IndikatorKinerja([
            'kode' => "IK-".($dataIK + 1),
            'deskripsi' => $request->input('deskripsi'),
            'bobot' => $request->input('bobot')
        ]);

        $cplInduk = $request->input('cpInduk');

        if($indikatorKinerja->save()){
            $cpIk = new PetaCpIk([
                '07_MASTER_capaian_pembelajaran_lulusan_id' => $cariCp->id,
                '08_MASTER_indikator_kinerja_id' => $indikatorKinerja->id,
            ]);
            
            $cpIk->save();

            for($i = 0; $i < 5; $i++){
                $rubrik = new Rubrik([
                    'urutan' => $i+1,
                    'level_kemampuan' => $level_kemampuan[$i],
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
        $kaprodiNip = '199301062019031017';
        $pemetaanIkCp = [];

        $ik = IndikatorKinerja::where('kode', $ik)
            ->with('capaianPembelajaranLulusan.kurikulum.programStudi')
            ->with('rubrik')
            ->get()
            ->first();

        $dataIk = IndikatorKinerja::get();
        foreach($dataIk as $data){
            // $data = IndikatorKinerja::leftJoin('13_master_peta_cp_ik as cpik', '08_master_indikator_kinerja.id', '=', 'cpik.08_MASTER_indikator_kinerja_id')
            // ->select('08_master_indikator_kinerja.*', 'cpik.*')
            // ->get();

            $pemetaanIkCp[] = IndikatorKinerja::where('id',$data->id)->whereHas('capaianPembelajaranLulusan', function($query) use ($data, $kurikulum, $kaprodiNip) {
                $query->where('08_master_indikator_kinerja_id', $data->id)
                ->whereHas('kurikulum', function($query) use ($kurikulum, $kaprodiNip) {
                    $query->where('tahun', $kurikulum)
                    ->whereHas('programStudi', function($query) use ($kaprodiNip) {
                        $query->where('koordinator_nip', $kaprodiNip);
                    });
                });
            })->get()->first();
        };
            
        return view('kaprodi.ik.show', [
            'title' => 'IK',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'dataIk' => $pemetaanIkCp,
            'ik' => $ik
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
        //
    }
}
