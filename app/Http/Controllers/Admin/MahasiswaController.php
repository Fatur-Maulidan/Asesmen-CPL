<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MahasiswaDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Imports\MahasiswaImport;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_06_Mahasiswa;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MahasiswaDataTable $dataTable)
    {
        return $dataTable->render('admin.mahasiswa.index', [
            'title' => 'Mahasiswa',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request, $kurikulum)
    {
        $validateData = $request->validated();
        $kurikulumModel = new Master_03_Kurikulum();

        $mahasiswaModel = new Master_06_Mahasiswa([
            'nim' => $validateData['nim'],
            'nama' => $validateData['nama'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'kelas' => date('Y') - $validateData['tahun_angkatan'] . $validateData['kelas'],  // Harus bisa menyeseuaikan dengan tahun angkatan dan jenjang pendidikan @PENDING
            'email' => $validateData['email'],
            'tahun_angkatan' => $validateData['tahun_angkatan'],
            'status' => StatusKeaktifan::Aktif,
            'tahun' => $kurikulum,
            '02_MASTER_program_studi_id' => $kurikulumModel->getProgramStudiId($kurikulum)
        ]);

        try {
            $mahasiswaModel->save();

            return redirect()->route('kaprodi.mahasiswa.index', compact('kurikulum'))->with('success', 'Berhasil menambahkan data');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = ($e->errorInfo[1] == 1062) ? 'NIM atau email yang sama sudah terdaftar!' : 'Gagal menambahkan data!';

            return redirect()->back()->with('error', $errorMessage)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($nim)
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
    public function update(MahasiswaRequest $request, $nim)
    {
        $mahasiswa = Master_06_Mahasiswa::find($nim);

        if ($request->ajax()) {
            $validated = $request->validated();

            $mahasiswa->update($validated);

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ]);
        }
    }

    public function toggleStatus($nim)
    {
        $mahasiswa = Master_06_Mahasiswa::find($nim);

        $mahasiswa->update([
            'status' => ($mahasiswa->status->is(StatusKeaktifan::Aktif)) ? StatusKeaktifan::Nonaktif : StatusKeaktifan::Aktif
        ]);

        return redirect()->back();
    }

    public function downloadTemplate()
    {
        $file_path = public_path('files/templates/Template_Mahasiswa.xlsx');

        return response()->download($file_path);
    }

    public function import()
    {
        Excel::import(new MahasiswaImport(), request()->file('formFile'));

        return redirect(route('admin.mahasiswa.index'));
    }
}
