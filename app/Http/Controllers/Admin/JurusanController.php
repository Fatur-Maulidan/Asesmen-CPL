<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Imports\JurusanImport;
use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use Maatwebsite\Excel\Facades\Excel;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Master_01_Jurusan::with(['programStudi', 'programStudi.kaprodi:id,nama', 'programStudi.kurikulumAktif']);
        $dosen = Master_04_Dosen::role('dosen')->get(['id', 'kode', 'nama']);

        if (request('filter') == 'rekayasa') {
            $jurusan->rekayasa();
        } elseif (request('filter') == 'non-rekayasa') {
            $jurusan->nonrekayasa();
        } else {
            $jurusan->search();
        }

        return view('admin.jurusan.index', [
            'title' => 'Jurusan',
            'jurusan' => $jurusan->get(),
            'dosen' => $dosen,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JurusanRequest $request)
    {
        if ($request->ajax()) {
            $validated = $request->validated();

            try {
                Master_01_Jurusan::create($validated);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
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
    public function update(JurusanRequest $request, $id)
    {
        if ($request->ajax()) {
            $jurusan = Master_01_Jurusan::find($id);
            $validated = $request->validated();

            try {
                $jurusan->update($validated);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ], 200);
        }
    }

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Jurusan.xlsx');

        return response()->download($file_path);
    }

    public function import()
    {
        Excel::import(new JurusanImport, request()->file('formFileJurusan'));

        return redirect(route('admin.jurusan.index'))->with('success', 'All good!');
    }
}
