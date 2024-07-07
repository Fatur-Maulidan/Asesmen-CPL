<?php

namespace App\Http\Controllers\Kaprodi;

use App\DataTables\MahasiswaDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Imports\MahasiswaImport;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_06_Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MahasiswaDataTable $dataTable, $tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        return $dataTable->with('kurikulum', $kurikulum)->render('kaprodi.mahasiswa.index', [
            'title' => 'Mahasiswa',
            'kurikulum' => $kurikulum,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request, $tahun_kurikulum)
    {
        if ($request->ajax()) {
            $validated = $request->validated();
            $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

            Master_06_Mahasiswa::create([
                'nim' => $validated['nim'],
                'nama' => $validated['nama'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'email' => $validated['email'],
                'tahun_angkatan' => $validated['tahun_angkatan'],
                'kelas' => ($validated['tahun_angkatan'] - date('Y') + 1) . $validated['kelas'],
                '02_MASTER_program_studi_id' => Auth::user()->kaprodi->id,
                '03_MASTER_kurikulum_id' => $kurikulum->id,
            ]);

            return redirect()->route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum])->with('success', 'Berhasil menambahkan data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($tahun_kurikulum, $nim)
    {
        if (request()->ajax()) {
            $mahasiswa = Master_06_Mahasiswa::find($nim);

            return response()->json([
                'mahasiswa' => $mahasiswa
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request, $tahun_kurikulum, $nim)
    {
        if ($request->ajax()) {
            $mahasiswa = Master_06_Mahasiswa::find($nim);

            if ($request->ajax()) {
                $validated = $request->validated();

                $mahasiswa->update($validated);

                return response()->json([
                    'message' => 'Data berhasil diubah.'
                ]);
            }
        }
    }

    public function toggleStatus($tahun_kurikulum, $nim)
    {
        $mahasiswa = Master_06_Mahasiswa::find($nim);

        $mahasiswa->update([
            'status' => ($mahasiswa->status->is(StatusKeaktifan::Aktif)) ? StatusKeaktifan::Nonaktif : StatusKeaktifan::Aktif
        ]);

        return redirect()->back();
    }

    public function downloadTemplate($tahun_kurikulum)
    {
        $file_path = public_path('files/templates/Template_Mahasiswa.xlsx');

        return response()->download($file_path);
    }

    public function import($tahun_kurikulum)
    {
        $kurikulum = Master_03_Kurikulum::getKurikulumByYearAndProdiStatic($tahun_kurikulum, Auth::user()->kaprodi->id);

        Excel::import(new MahasiswaImport(Auth::user()->kaprodi->id, $kurikulum->id), request()->file('formFile'));

        return redirect(route('kaprodi.mahasiswa.index', ['kurikulum' => $tahun_kurikulum]))->with('success', 'All good!');
    }
}
