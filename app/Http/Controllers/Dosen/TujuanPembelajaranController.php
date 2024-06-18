<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TujuanPembelajaranStoreRequest;
use App\Models\Master_13_TujuanPembelajaran;
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
        $dataTp = Master_13_TujuanPembelajaran::all();
        return view('dosen.tujuan-pembelajaran.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'dataTp' => $dataTp,
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

        $dataTp = Master_13_TujuanPembelajaran::get()->count();
        $tujuanPembelajaran = new Master_13_TujuanPembelajaran([
            'kode' => "TP-".($dataTp + 1),
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

        $dataTp = Master_13_TujuanPembelajaran::find($id);
        $dataTp->deskripsi = $request->input('deskripsi');
        $dataTp->tanggal_diajukan = date('Y-m-d H:i:s');

        if($dataTp->save()) {
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
        $dataTp = Master_13_TujuanPembelajaran::find($id);
        if($dataTp->delete()) {
            return redirect(route('dosen.mata-kuliah.tujuan-pembelajaran',['kodeMataKuliah' => $kodeMataKuliah]))->with('success', 'Tujuan Pembelajaran berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal dihapus');
        }
    }

    public function detailInformasi($kodeMataKuliah, $id) {
        $tp = Master_13_TujuanPembelajaran::find($id);
        $dataTp = Master_13_TujuanPembelajaran::get();
        return view('dosen.tujuan-pembelajaran.detail-informasi', [
            'title' => 'Detail Informasi Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'tp' => $tp,
            'dataTp' => $dataTp,
            'kodeMataKuliah' => $kodeMataKuliah
        ]);
    }
}
