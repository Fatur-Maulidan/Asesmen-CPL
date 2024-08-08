<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Master_07_MataKuliah;
use App\Models\Master_19_NilaiMahasiswa;
use Illuminate\Http\Request;

class NilaiMahasiswaController extends Controller
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
            }],'mataKuliahRegister.rencanaAsesmen.mahasiswa', 'mataKuliahRegister.mahasiswa')
            ->first();

        return view('dosen.nilai-mahasiswa.index', [
            'title' => 'Nilai Mahasiswa',
            'nama' => Auth::user()->nama,
            'role' => 'Dosen',
            'jenis' => $jenis,
            'mata_kuliah' => $mata_kuliah,
            'kurikulum' => $mata_kuliah->kurikulum,
        ]);
    }

    public function update(Request $request, $kodeMataKuliah, $jenis, $nim, $rencanaAsesmen)
    {
        $this->validate($request, [
            'nilai' => 'required|numeric',
        ]);

        $mata_kuliah = Master_07_MataKuliah::where('kode', $kodeMataKuliah)
            ->with(['mataKuliahRegister' => function($query) use ($jenis) {
                $query->where('jenis', $jenis);
            }],'mataKuliahRegister.rencanaAsesmen.mahasiswa', 'mataKuliahRegister.mahasiswa')
            ->first();

        // $nilai_mahasiswa = Master_19_NilaiMahasiswa::where('06_MASTER_mahasiswa_nim', $nim)
        //     ->where('15_MASTER_rencana_asesmen_id', $rencanaAsesmen)
        //     ->first();

        // $nilai_mahasiswa->nilai = $request->nilai;

        if(Master_19_NilaiMahasiswa::where('06_MASTER_mahasiswa_nim', $nim)
        ->where('15_MASTER_rencana_asesmen_id', $rencanaAsesmen)
        ->update(['nilai' => $request->nilai])) {
            return redirect()->route('dosen.mata-kuliah.nilai-mahasiswa.index', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $jenis])->with('success', 'Nilai berhasil diupdate');
        } else {
            return redirect()->route('dosen.mata-kuliah.nilai-mahasiswa.index', ['kodeMataKuliah' => $mata_kuliah->kode, 'jenis' => $jenis])->with('error', 'Nilai gagal diupdate');
        };
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
