<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RencanaAsesmenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.rencana-asesmen.index', [
            'title' => 'Rencana Asesmen',
            'nama' => 'John Doe',
            'role' => 'Dosen'
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
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        return view('dosen.rencana-asesmen.ubah-detail-informasi', [
            'title' => 'Ubah Rencana Asesmen',
            'nama' => 'John Doe',
            'role' => 'Dosen'
        ]);
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

    public function detailInformasi() {
        return view('dosen.rencana-asesmen.detail-informasi', [
            'title' => 'Detail Informasi Rencana Asesmen',
            'nama' => 'John Doe',
            'role' => 'Dosen'
        ]);
    }

    public function nilaiMahasiswa() {
        return view('dosen.rencana-asesmen.nilai-mahasiswa', [
            'title' => 'Nilai Mahasiswa',
            'nama' => 'John Doe',
            'role' => 'Dosen'
        ]);
    }
}
