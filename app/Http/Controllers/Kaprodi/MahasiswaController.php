<?php

namespace App\Http\Controllers\Kaprodi;

use App\DataTables\MahasiswaDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Imports\MahasiswaImport;
use App\Models\Dosen;
use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Dosen::with('programStudi:id,koordinator_nip',)->find('810317609391432000');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum, MahasiswaDataTable $dataTable)
    {
        return $dataTable->with('kurikulum', $kurikulum)->render('kaprodi.mahasiswa.index', [
            'title' => 'Mahasiswa',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum
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
     * @param  \App\Http\Requests\MahasiswaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MahasiswaRequest $request, $kurikulum)
    {
        // Stub purpose only, value aslinya dihasilkan berdasarkan tahun akademik yang dipilih
        $kurikulum = '2021';

        $validateData = $request->validated();
        $kurikulumModel = new Kurikulum();

        $mahasiswaModel = new Mahasiswa([
            'nim' => $validateData['nim'],
            'nama' => $validateData['nama'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'kelas' => $validateData['kelas'],
            'email' => $validateData['email'],
            'tahun_angkatan' => $validateData['tahun_angkatan'],
            'status' => StatusKeaktifan::Aktif,
            'tahun' => $kurikulum,
            '02_MASTER_program_studi_id' => $kurikulumModel->getProgramStudiId($kurikulum)
        ]);

        try {
            $mahasiswaModel->save();

            return redirect()->route('kaprodi.mahasiswa.index')->with('success', 'Berhasil menambahkan data');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorMessage = ($e->errorInfo[1] == 1062) ? 'NIM atau email yang sama sudah terdaftar!' : 'Gagal menambahkan data!';

            return redirect()->back()->with('error', $errorMessage)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kurikulum, $nim)
    {
        if (request()->ajax()) {
            $mahasiswa = Mahasiswa::find($nim);

            return response()->json([
                'mahasiswa' => $mahasiswa
            ]);
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
    public function update(MahasiswaRequest $request, $kurikulum, $nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

        if ($request->ajax()) {
            $validated = $request->validated();

            $mahasiswa->update($validated);

            return response()->json([
                'message' => 'Data berhasil diubah.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kurikulum, $nim)
    {
        Mahasiswa::destroy($nim);

        return redirect()->back();
    }

    public function toggleStatus($kurikulum, $nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

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

    public function import($kurikulum)
    {
        Excel::import(new MahasiswaImport($this->user->programStudi->id), request()->file('formFile'));

        return redirect(route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum]))->with('success', 'All good!');
    }
}
