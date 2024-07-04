<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramStudiRequest;
use App\Imports\ProgramStudiImport;
use App\Models\Master_02_ProgramStudi;
use App\Models\Master_04_Dosen;
use Illuminate\Support\Facades\DB;

class ProgramStudiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramStudiRequest $request)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $validated['01_MASTER_jurusan_id'] = $validated['id_jurusan'];
            $validated['04_MASTER_dosen_id'] = $validated['id_dosen'];

            $program_studi_exist = Master_02_ProgramStudi::where('nama', $validated['nama'])
                ->where('jenjang_pendidikan', $validated['jenjang_pendidikan'])->first();

            if ($program_studi_exist) {
                return response()->json([
                    'message' => 'Program Studi sudah terdaftar.'
                ], 409);
            }

            try {
                Master_02_ProgramStudi::create($validated);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil ditambah.'
            ], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProgramStudiRequest $request, $id)
    {
        if ($request->ajax()) {
            $program_studi = Master_02_ProgramStudi::find($id);

            $validated = $request->validated();
            $validated['04_MASTER_dosen_id'] = $validated['id_dosen'];

            $dosen = Master_04_Dosen::find($validated['id_dosen']);
            $program_studi_exist = Master_02_ProgramStudi::where('nama', $validated['nama'])
                ->where('jenjang_pendidikan', $validated['jenjang_pendidikan'])->first();

            if ($program_studi_exist && ($program_studi_exist->id != $program_studi->id)) {
                return response()->json([
                    'message' => 'Program Studi sudah terdaftar.'
                ], 409);
            }

            try {
                DB::transaction(function () use ($program_studi, $validated, $dosen) {
                    if ($dosen) {
                        $dosen->syncRoles(['koordinator program studi']);
                    } else {
                        if ($program_studi->kaprodi) {
                            $program_studi->kaprodi->syncRoles(['dosen']);
                        }
                    }
                    $program_studi->update($validated);
                });
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ], 200);
        }
    }

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Program_Studi.xlsx');

        //return Excel::download(new ProgramStudiExport, 'Template_Program_Studi.xlsx');
        return response()->download($file_path);
    }

    public function import()
    {
        $import = new ProgramStudiImport();
        $import->import(request()->file('formFileProgramStudi'));

        return redirect(route('admin.jurusan.index'));
    }
}
