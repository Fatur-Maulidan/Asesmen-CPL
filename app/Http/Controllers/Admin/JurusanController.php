<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Imports\JurusanImport;
use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Master_01_Jurusan::with(['programStudi', 'programStudi.dosen:nip,nama', 'programStudi.kurikulumAktif']);

        if (request('filter') == 'rekayasa') {
            $jurusan->rekayasa();
        } elseif (request('filter') == 'non-rekayasa') {
            $jurusan->nonrekayasa();
        } else {
            $jurusan->search();
        }

        return view('admin.jurusan.index', [
            'title' => 'Jurusan',
            'nama' => 'John Tyler',
            'role' => 'Admin',
            'jurusan' => $jurusan->get(),
            'dosen' => Master_04_Dosen::get(['nip', 'kode', 'nama'])
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
    public function store(JurusanRequest $request)
    {
        $validated = $request->validated();

        Master_01_Jurusan::create($validated);

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
        // $jurusan = Master01Jurusan::find($id);

        // return response()->json([
        //     'jurusan' => $jurusan
        // ]);
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
     * @param  int  $nomor
     * @return \Illuminate\Http\Response
     */
    public function update(JurusanRequest $request, $nomor)
    {
        $jurusan = Master_01_Jurusan::find($nomor);
        $validated = $request->validated();

        $jurusan->update($validated);

        return response()->json([
            'message' => 'Data berhasil diubah.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Master_01_Jurusan::find($id);

        if ($jurusan->programStudi()->exists()) {
            return redirect()->back()->with('message', 'Tidak dapat menghapus jurusan yang memiliki program studi.');
        }
        Master_01_Jurusan::destroy($id);

        return redirect()->back();
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
