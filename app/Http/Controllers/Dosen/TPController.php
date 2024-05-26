<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TujuanPembelajaranStoreRequest;
use App\Models\TujuanPembelajaran;
use Illuminate\Support\Facades\Validator;

class TPController extends Controller
{
    protected $validation;
    public function __construct(){
        $this->validation = new TujuanPembelajaranStoreRequest();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeMataKuliah)
    {
        return view('dosen.tujuan-pembelajaran.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah
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
        $validator = Validator::make(
            $request->all(), 
            $this->validation->rules(), 
            $this->validation->message()
        );

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataTP = TujuanPembelajaran::get();
        dd($dataTP);
        $tujuanPembelajaran = new TujuanPembelajaran([
            'kodeTP' => "TP-".($dataTP + 1),
            'deskripsi' => $request->input('deskripsi'),
            'bobot' => $request->input('bobot')
        ]);

        if($tujuanPembelajaran->save()) {
            return redirect()->back()->with('success', 'Tujuan Pembelajaran berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal ditambahkan');
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
    public function update(Request $request, $id)
    {
        
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

    public function detailInformasi($kodeMataKuliah) {
        return view('dosen.tujuan-pembelajaran.detail-informasi', [
            'title' => 'Detail Informasi Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'kodeMataKuliah' => $kodeMataKuliah
        ]);
    }
}
