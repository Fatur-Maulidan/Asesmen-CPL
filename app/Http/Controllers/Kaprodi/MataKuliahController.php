<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Imports\MataKuliahImport;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_11_MataKuliahRegister;
use App\Models\Master_12_PetaIkMk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    protected $user;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    protected $indikatorKinerja;

    public function __construct() {
        $this->user = Master_04_Dosen::with('programStudi:id,koordinator_nip',)->find('195905211994031001');
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Master_04_Dosen();
        $this->kurikulum = new Master_03_Kurikulum();
        $this->indikatorKinerja = new Master_09_IndikatorKinerja();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $this->kaprodi = $this->kaprodi->getProdiKodeByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByNomorProdi($this->kaprodi->programStudi->first()->nomor, $kurikulum);
        
        return view('kaprodi.mk.index', [
            'title' => 'Mata Kuliah',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            // 'kurikulum' => $kurikulum,
            'mata_kuliah' => Master_07_MataKuliah::all(),
            'kurikulum' => $this->kurikulum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MataKuliahRequest $request, $kurikulum)
    {
        if ($request->ajax()) {
            $kurikulum_id = Master_03_Kurikulum::whereRelation('programStudi', 'id', $this->user->{'02_MASTER_program_studi_id'})
                ->where('tahun', $kurikulum)->pluck('id')->first();
            $validated = $request->validated();
            $validated['03_MASTER_kurikulum_id'] = $kurikulum_id;

            Master_07_MataKuliah::create($validated);

            return response()->json([
                'message' => 'Data berhasil disimpan',
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kurikulum, $kode)
    {
        $mataKuliah = new Master_07_MataKuliah;

        $this->kaprodi = $this->kaprodi->getProdiKodeByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByNomorProdi($this->kaprodi->programStudi->first()->nomor, $kurikulum);
        $daftarMataKuliah = Master_07_MataKuliah::where('03_MASTER_kurikulum_id',$this->kurikulum->id)->get();
        $mataKuliah = $mataKuliah->getMataKuliahByKodeAndKurikulum($kode, $this->kurikulum->id);

        $this->indikatorKinerja = $this->indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id);
        return view('kaprodi.mk.show', [
            'title' => 'Mata Kuliah',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
            'daftar_mata_kuliah' => $daftarMataKuliah,
            'detail_mata_kuliah' => $mataKuliah,
            'indikator_kinerja' => $this->indikatorKinerja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MataKuliahRequest $request, $kurikulum, $id)
    {
        $validated = $request->validated();

        $this->kaprodi = $this->kaprodi->getProdiKodeByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByNomorProdi($this->kaprodi->programStudi->first()->nomor, $kurikulum);
        $mataKuliah = Master_07_MataKuliah::find($id);

        $mataKuliah->update($validated);

        // return response()->json([
        //     'message' => 'Data berhasil disimpan',
        // ]);

        return redirect()->route('kaprodi.mata-kuliah.show', [
            'kurikulum' => $kurikulum,
            'mata_kuliah' => $mataKuliah->kode 
        ]);
    }

    public function pemetaan(Request $request, $kurikulum, $id)
    {
        $indikatorKinerja = new Master_09_IndikatorKinerja();
        $jenis = "Praktik";
        $mataKuliah = Master_07_MataKuliah::find($id);
        $mataKuliahRegister = Master_11_MataKuliahRegister::where('07_MASTER_mata_kuliah_id', $mataKuliah->id)->where('jenis',$jenis)->first();
        
        $this->kaprodi = $this->kaprodi->getProdiKodeByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByNomorProdi($this->kaprodi->programStudi->first()->nomor, $kurikulum);

        foreach($request->input('checkbox') as $ik){
            $petaIkMk[] = [
                '11_MASTER_mk_register_id' => $mataKuliahRegister->id,
                '09_MASTER_indikator_kinerja_id' => $indikatorKinerja->getDataIndikatorKinerja($this->kurikulum->id,'', $ik)->first()->id,
            ];
        }
        if(Master_12_PetaIkMk::insert($petaIkMk)){
            return redirect()->route('kaprodi.mata-kuliah.show', [
                'kurikulum' => $kurikulum,
                'mata_kuliah' => $mataKuliah->kode 
            ])->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('kaprodi.mata-kuliah.show', [
                'kurikulum'=> $kurikulum,
                'mata_kuliah'=> $mataKuliah->kode
            ])->with('error', 'Data gagal disimpan');
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

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Mata_Kuliah.xlsx');

        return response()->download($file_path);
    }

    public function import($kurikulum)
    {
        $kurikulum_id = Master_03_Kurikulum::whereRelation('programStudi', 'id', $this->user->{'02_MASTER_program_studi_id'})
            ->where('tahun', $kurikulum)->pluck('id')->first();
        Excel::import(new MataKuliahImport($kurikulum_id), request()->file('formFile'));

        return redirect()->back();
    }
}
