<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_04_Dosen;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_14_PetaIkTp;
use Illuminate\Http\Request;
use App\Http\Requests\TujuanPembelajaranStoreRequest;
use App\Http\Requests\TujuanPembelajaranUpdateRequest;
use App\Models\Master_12_PetaIkMk;
use App\Models\Master_13_TujuanPembelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TujuanPembelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kodeMataKuliah, $jenis)
    {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }],'mataKuliahRegister.indikatorKinerja')
            ->first();
        $data_tp = Master_13_TujuanPembelajaran::where('11_MASTER_mk_register_id', $mata_kuliah->mataKuliahRegister[0]->id)
            ->with('petaIkMk.indikatorKinerja')
            ->get();
        return view('dosen.tujuan-pembelajaran.index', [
            'title' => 'Tujuan Pembelajaran',
            'nama' => Auth::user()->nama,
            'data_tp' => $data_tp,
            'mata_kuliah' => $mata_kuliah
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TujuanPembelajaranStoreRequest $request, $kodeMataKuliah, $jenis)
    { 
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }])
            ->first();

        $data_tp = $this->getDataTP($mata_kuliah)->count();

        $tujuan_pembelajaran = new Master_13_TujuanPembelajaran([
            'kode' => "TP-".($data_tp + 1),
            'deskripsi' => $request->input('deskripsi'),
            '11_MASTER_mk_register_id' => $mata_kuliah->mataKuliahRegister[0]->id,
        ]);

        if($tujuan_pembelajaran->save()) {
            foreach($request->input('checkbox') as $index => $value){
                $pemetaan_id =  Master_12_PetaIkMk::where('09_MASTER_indikator_kinerja_id', $index)
                    ->where('11_MASTER_mk_register_id', $mata_kuliah->mataKuliahRegister[0]->id)
                    ->first()->id;
                $pemetaan = new Master_14_PetaIkTp([
                    '12_MASTER_peta_ik_mk_id' => $pemetaan_id,
                    '13_MASTER_tujuan_pembelajaran_id' => $tujuan_pembelajaran->id,
                    'bobot_tp' => $request->input('bobot')
                ]);

                $pemetaan->save();
            }
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
    public function update(TujuanPembelajaranUpdateRequest $request, $kodeMataKuliah, $jenis ,$id)
    {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }])
            ->first();

        $data_tp = Master_13_TujuanPembelajaran::find($id);
        $data_tp->deskripsi = $request->input('deskripsi');
        $data_tp->updated_at = date('Y-m-d H:i:s');

        if($data_tp->save()) {
            return redirect()->route('dosen.mata-kuliah.tujuan-pembelajaran.detail-informasi', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $jenis, 'id' => $id])->with('success', 'Tujuan Pembelajaran berhasil diperbaharui');
        } else {
            return redirect()->route('dosen.mata-kuliah.tujuan-pembelajaran.detail-informasi', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $jenis, 'id' => $id])->with('error', 'Tujuan Pembelajaran gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodeMataKuliah,$jenis,$id)
    {
        $data_tp = Master_13_TujuanPembelajaran::find($id);
        if($data_tp->petaIkMk->isNotEmpty()){
            foreach($data_tp->petaIkMk as $peta_ik_mk){
                $peta_ik_mk->pivot->delete();
            }
        }
        if($data_tp->delete()) {
            return redirect(route('dosen.mata-kuliah.tujuan-pembelajaran',['kodeMataKuliah' => $kodeMataKuliah, 'jenis' => $jenis]))->with('success', 'Tujuan Pembelajaran berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Tujuan Pembelajaran gagal dihapus');
        }
    }

    public function detailInformasi($kodeMataKuliah, $jenis ,$id) {
        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }],'mataKuliahRegister.indikatorKinerja')
            ->first();
        $tp = Master_13_TujuanPembelajaran::with('petaIkMk.indikatorKinerja')->find($id);
        $data_tp = $this->getDataTP($mata_kuliah);
        return view('dosen.tujuan-pembelajaran.detail-informasi', [
            'title' => 'Detail Informasi Tujuan Pembelajaran',
            'nama' => 'John Doe',
            'role' => 'Dosen',
            'tp' => $tp,
            'data_tp' => $data_tp,
            'mata_kuliah' => $mata_kuliah,
            'jenis' => $jenis
        ]);
    }

    private function getDataTP($mata_kuliah){
        $data_tp = Master_13_TujuanPembelajaran::with(['petaIkMk' => function($query) use ($mata_kuliah) {
            $query->where('11_MASTER_mk_register_id', $mata_kuliah->mataKuliahRegister[0]->id);
        }])->get();

        return $data_tp;
    }
}
