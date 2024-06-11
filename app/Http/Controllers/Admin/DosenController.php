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
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Do_;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DosenDataTable $dataTable)
    {
        $filter = [];
        if (request('jurusan')) {
            $filter['jurusan'] = request('jurusan');
        }

        return $dataTable->with('filter', $filter)->render('admin.dosen.index', [
            'title' => 'Dosen',
            'nama' => 'John Tyler',
            'role' => 'Admin',
            'jurusan' => Master_01_Jurusan::get(['nomor', 'nama']),
            'prodi' => Master_02_ProgramStudi::orderBy('jenjang_pendidikan')->get(['nomor', 'nama', 'jenjang_pendidikan']),
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
    public function store(DosenRequest $request)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $validated['01_MASTER_jurusan_nomor'] = $validated['jurusan'];
            unset($validated['jurusan']);

            $dosen = Master_04_Dosen::create($validated);
            $dosen->programStudi()->sync($validated['program_studi']);

            return response()->json([
                'message' => 'Data berhasil ditambah.'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        if (request()->ajax()) {
            $dosen = Master_04_Dosen::with('programStudi:nomor,nama,jenjang_pendidikan')->find($kode);

            return response()->json([
                'dosen' => $dosen
            ]);
        }
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
    public function update(DosenRequest $request, $kode)
    {
        $dosen = Master_04_Dosen::find($kode);

        if ($request->ajax()) {
            $validated = $request->validated();
            $validated['01_MASTER_jurusan_nomor'] = $validated['jurusan'];
            unset($validated['jurusan']);

            $old_prodi = [];
            foreach ($dosen->programStudi as $prodi) {
                array_push($old_prodi, $prodi->nomor);
            }

            if ($old_prodi != $validated['program_studi']) {
                foreach ($old_prodi as $prodi) {
                    $dosen->programStudi()->detach($prodi);
                }
            }

            $dosen->update($validated);
            $dosen->programStudi()->sync($validated['program_studi']);

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode)
    {
        Master_04_Dosen::destroy($kode);

        return redirect()->back();
    }

    public function toggleStatus($nip)
    {
        $dosen = Master_04_Dosen::find($nip);

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
