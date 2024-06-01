<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kaprodiNip = '199301062019031017';
        $kurikulum = Kurikulum::whereHas('programStudi', function($query) use ($kaprodiNip) {
                        $query->where('koordinator_nip', $kaprodiNip);
                    })
                    ->with('programStudi')
                    ->get();

        return view('kaprodi.kurikulum.index', [
            'title' => 'Home',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'dataKurikulum' => $kurikulum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kaprodi.kurikulum.create', [
            'title' => 'Tambah Kurikulum Baru',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi'
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
