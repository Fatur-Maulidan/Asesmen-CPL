<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DosenDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Imports\DosenImport;
use App\Models\Master_02_ProgramStudi;
use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DosenDataTable $dataTable)
    {
        $filter = [];
        if (request('jurusan')) {
            $filter['jurusan'] = request('jurusan');
        }

        $jurusan = Master_01_Jurusan::get(['id', 'nama']);
        $program_studi = Master_02_ProgramStudi::orderBy('jenjang_pendidikan')->get(['id', 'nama', 'jenjang_pendidikan']);

        return $dataTable->with('filter', $filter)->render('admin.dosen.index', [
            'title' => 'Dosen',
            'jurusan' => $jurusan,
            'program_studi' => $program_studi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DosenRequest $request)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $validated['01_MASTER_jurusan_id'] = $validated['jurusan'];
            unset($validated['jurusan']);
            $validated['kata_sandi'] = Hash::make('password');

            try {
                DB::transaction(function () use ($validated) {
                    $dosen = Master_04_Dosen::create($validated);
                    $dosen->assignRole('dosen');
                    $dosen->programStudi()->sync($validated['program_studi']);
                });
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
     * Display the specified resource.
     */
    public function show($id)
    {
        if (request()->ajax()) {
            $dosen = Master_04_Dosen::with('programStudi:id,nama,jenjang_pendidikan')->find($id);

            return response()->json([
                'dosen' => $dosen
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DosenRequest $request, $id)
    {
        if ($request->ajax()) {
            $dosen = Master_04_Dosen::find($id);

            $validated = $request->validated();
            $validated['01_MASTER_jurusan_id'] = $validated['jurusan'];
            unset($validated['jurusan']);

            $old_prodi = [];
            foreach ($dosen->programStudi as $prodi) {
                array_push($old_prodi, $prodi->id);
            }

            if ($old_prodi != $validated['program_studi']) {
                foreach ($old_prodi as $prodi) {
                    $dosen->programStudi()->detach($prodi);
                }
            }

            DB::transaction(function () use ($dosen, $validated) {
                $dosen->update($validated);
                $dosen->programStudi()->sync($validated['program_studi']);
            });

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ]);
        }
    }

    public function toggleStatus($id)
    {
        $dosen = Master_04_Dosen::find($id);

        $dosen->update([
            'status' => ($dosen->status->is(StatusKeaktifan::Aktif)) ? StatusKeaktifan::Nonaktif : StatusKeaktifan::Aktif
        ]);

        return redirect()->back();
    }

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Dosen.xlsx');

        return response()->download($file_path);
    }

    public function import()
    {
        Excel::import(new DosenImport, request()->file('formFile'));

        return redirect(route('admin.dosen.index'))->with('success', 'All good!');
    }
}
