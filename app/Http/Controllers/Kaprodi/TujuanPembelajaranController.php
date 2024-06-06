<?php

namespace App\Http\Controllers\Kaprodi;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class TujuanPembelajaranController extends Controller
{
    protected $validator;
    protected $kaprodiNip;
    protected $kaprodi;
    protected $kurikulum;
    
    public function __construct()
    {
        $this->kaprodiNip = '199301062019031017';
        $this->kaprodi = new Dosen();
        $this->kurikulum = new Kurikulum();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum)
    {
        $this->kaprodi = $this->kaprodi->getProdiIdByDosenNip($this->kaprodiNip);
        $this->kurikulum = $this->kurikulum->getKurikulumByProdiId($this->kaprodi->programStudi->id, $kurikulum);

        return view('kaprodi.tp.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum
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
