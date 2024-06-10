<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JurusanRequest;
use App\Imports\JurusanImport;
use App\Models\Dosen;
use App\Models\Jurusan;
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
        $jurusan = Jurusan::with(['programStudi', 'programStudi.dosen:nip,nama']);

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
            'dosen' => Dosen::get(['nip', 'kode', 'nama'])
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

        Jurusan::create([
            'nama' => $validated['nama_jurusan'],
            'golongan' => $validated['golongan_jurusan'],
        ]);

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
        // $jurusan = Jurusan::find($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurusanRequest $request, $id)
    {
        $jurusan = Jurusan::find($id);
        $validated = $request->validated();

        $jurusan->update([
            'nama' => $validated['nama_jurusan'],
            'golongan' => $validated['golongan_jurusan'],
        ]);

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
        $jurusan = Jurusan::find($id);

        if ($jurusan->programStudi()->exists()) {
            return redirect()->back()->with('message', 'Tidak dapat menghapus jurusan yang memiliki program studi.');
        }
        Jurusan::destroy($id);

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
