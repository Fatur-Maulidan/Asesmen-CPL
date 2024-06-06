<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TujuanPembelajaranStoreRequest;
use App\Models\TujuanPembelajaran;
use Illuminate\Support\Facades\Validator;

class TujuanPembelajaranController extends Controller
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
        $dataTP = TujuanPembelajaran::all();
        return view('dosen.tujuan-pembelajaran.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'dataTP' => $dataTP,
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

        $dataTP = TujuanPembelajaran::get()->count();
        $tujuanPembelajaran = new TujuanPembelajaran([
            'kode' => "TP-".($dataTP + 1),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_diajukan' => date('Y-m-d H:i:s')
        ]);

        if($tujuanPembelajaran->save()) {
            return redirect()->back()->with('success', 'Tujuan Pembelajaran berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal ditambahkan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kodeMataKuliah, $id)
    {
        $validator = Validator::make(
            $request->all(), 
            $this->validation->rules(), 
            $this->validation->message()
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataTP = TujuanPembelajaran::find($id);
        $dataTP->deskripsi = $request->input('deskripsi');
        $dataTP->tanggal_diajukan = date('Y-m-d H:i:s');

        if($dataTP->save()) {
            return redirect()->back()->with('success', 'Tujuan Pembelajaran berhasil diperbaharui');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodeMataKuliah,$id)
    {
        $dataTP = TujuanPembelajaran::find($id);
        if($dataTP->delete()) {
            return redirect(route('dosen.mata-kuliah.tujuan-pembelajaran',['kodeMataKuliah' => $kodeMataKuliah]))->with('success', 'Tujuan Pembelajaran berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal dihapus');
        }
    }

    public function detailInformasi($kodeMataKuliah, $id) {
        $tp = TujuanPembelajaran::find($id);
        $dataTP = TujuanPembelajaran::get();
        return view('dosen.tujuan-pembelajaran.detail-informasi', [
            'title' => 'Detail Informasi Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'tp' => $tp,
            'dataTP' => $dataTP,
            'kodeMataKuliah' => $kodeMataKuliah
        ]);
    }
}
