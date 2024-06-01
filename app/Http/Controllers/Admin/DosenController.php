<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DosenDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DosenDataTable $dataTable)
    {
        return $dataTable->render('admin.dosen.index', [
            'title' => 'Dosen',
            'nama' => 'John Tyler',
            'role' => 'Admin',
            'jurusan' => Jurusan::get(['id', 'nama'])
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

            Dosen::create($validated);

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
    public function show($nip)
    {
        if (request()->ajax()) {
            $dosen = Dosen::find($nip);

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
    public function update(DosenRequest $request, $nip)
    {
        if ($request->ajax()) {
            $dosen = Dosen::find($nip);

            $validated = $request->validated();

            $dosen->update($validated);

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
    public function destroy($nip)
    {
        Dosen::destroy($nip);

        return redirect()->back();
    }

    public function toggleStatus($nip)
    {
        $dosen = Dosen::find($nip);

        $dosen->update([
            'status' => ($dosen->status->is(StatusKeaktifan::Aktif)) ? StatusKeaktifan::Nonaktif : StatusKeaktifan::Aktif
        ]);

        return redirect()->back();
    }
}
