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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\Do_;
use Spatie\Permission\Models\Role;

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

        $jurusan = Master_01_Jurusan::get(['id', 'nama']);
        $program_studi = Master_02_ProgramStudi::orderBy('jenjang_pendidikan')->get(['id', 'nama', 'jenjang_pendidikan']);

        return $dataTable->with('filter', $filter)->render('admin.dosen.index', [
            'title' => 'Dosen',
            'jurusan' => $jurusan,
            'program_studi' => $program_studi,
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
            $validated['01_MASTER_jurusan_id'] = $validated['jurusan'];
            unset($validated['jurusan']);
            $validated['kata_sandi'] = Hash::make('password');

            $dosen = Master_04_Dosen::create($validated);
            $dosen->assignRole('dosen');
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
