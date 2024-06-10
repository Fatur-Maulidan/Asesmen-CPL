<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramStudiRequest;
use App\Imports\JurusanImport;
use App\Imports\ProgramStudiImport;
use App\Models\Master_02_ProgramStudi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProgramStudiRequest $request)
    {
        $validated = $request->validated();
        $validated['01_MASTER_jurusan_nomor'] = $validated['jurusan_nomor'];
        $validated['04_MASTER_dosen_kode'] = $validated['koordinator_prodi'];

        Master_02_ProgramStudi::create($validated);

        return response()->json([
            'message' => 'Data berhasil ditambah.'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param  int  $nomor
     * @return \Illuminate\Http\Response
     */
    public function destroy($nomor)
    {
        Master_02_ProgramStudi::destroy($nomor);

        return redirect()->back();
    }

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Program_Studi.xlsx');

        return response()->download($file_path);
    }

    public function import()
    {
        $import = new ProgramStudiImport();
        $import->import(request()->file('formFileProgramStudi'));

        return redirect(route('admin.jurusan.index'));
    }
}
