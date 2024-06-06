<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Imports\MataKuliahImport;
use App\Models\Dosen;
use App\Models\Kurikulum;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Dosen::with('programStudi:id,koordinator_nip',)->find('195905211994031001');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        return view('kaprodi.mk.index', [
            'title' => 'Mata Kuliah',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'mata_kuliah' => MataKuliah::all()
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
            $kurikulum_id = Kurikulum::whereRelation('programStudi', 'id', $this->user->{'02_MASTER_program_studi_id'})
                ->where('tahun', $kurikulum)->pluck('id')->first();
            $validated = $request->validated();
            $validated['03_MASTER_kurikulum_id'] = $kurikulum_id;

            MataKuliah::create($validated);

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
    public function show($kurikulum, $id)
    {
        return view('kaprodi.mk.show', [
            'title' => 'Mata Kuliah',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
            'mk' => [
                'kode' => '21IF001',
                'nama' => 'Dasar Dasar Pemrograman'
            ]
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

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Mata_Kuliah.xlsx');

        return response()->download($file_path);
    }

    public function import($kurikulum)
    {
        $kurikulum_id = Kurikulum::whereRelation('programStudi', 'id', $this->user->{'02_MASTER_program_studi_id'})
            ->where('tahun', $kurikulum)->pluck('id')->first();
        Excel::import(new MataKuliahImport($kurikulum_id), request()->file('formFile'));

        return redirect()->back();
    }
}
