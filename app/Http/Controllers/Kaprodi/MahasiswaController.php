<?php

namespace App\Http\Controllers\Kaprodi;

use App\DataTables\MahasiswaDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Imports\MahasiswaImport;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_06_Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    protected $user;
    protected $kurikulum;

    public function __construct()
    {
        $this->user = Master_04_Dosen::with('kaprodi')->find('KO042N');
        $this->kurikulum = new Master_03_Kurikulum();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($kurikulum, MahasiswaDataTable $dataTable)
    {
        $this->kurikulum = $this->kurikulum->getKurikulumByYearAndProdi($kurikulum, $this->user->kaprodi->nomor);

        return $dataTable->with('kurikulum', $this->kurikulum)->render('kaprodi.mahasiswa.index', [
            'title' => 'Mahasiswa',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $this->kurikulum,
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
     * @param \App\Http\Requests\MahasiswaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MahasiswaRequest $request, $kurikulum)
    {
        $validateData = $request->validated();
        $this->kurikulum = $this->kurikulum->getKurikulumByYearAndProdi($kurikulum, $this->user->kaprodi->nomor);

        $mahasiswaModel = new Master_06_Mahasiswa([
            'nim' => $validateData['nim'],
            'nama' => $validateData['nama'],
            'email' => $validateData['email'],
            'jenis_kelamin' => $validateData['jenis_kelamin'],
            'kelas' => ($validateData['tahun_angkatan'] - date('Y') + 1) . $validateData['kelas'],
            'tahun_angkatan' => $validateData['tahun_angkatan'],
            'status' => StatusKeaktifan::Aktif,
            'tahun' => $this->kurikulum->tahun,
            '02_MASTER_program_studi_nomor' => $this->user->kaprodi->nomor,
            '03_MASTER_kurikulum_id' => $this->kurikulum->id,
        ]);

        $mahasiswaModel->save();
        return redirect()->route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum])->with('success', 'Berhasil menambahkan data');
        //try {
        //
        //    return response()->json([
        //        'success' => true,
        //    ], 201);
        //} catch (\Illuminate\Database\QueryException $e) {
        //    $errorMessage = ($e->errorInfo[1] == 1062) ? 'NIM atau email yang sama sudah terdaftar!' : 'Gagal menambahkan data!';
        //
        //    //return redirect()->back()->with('error', $errorMessage)->withInput();
        //    return response()->json([
        //        'error' => $errorMessage,
        //    ], 201);
        //}
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($kurikulum, $nim)
    {
        if (request()->ajax()) {
            $mahasiswa = Master_06_Mahasiswa::find($nim);

            return response()->json([
                'mahasiswa' => $mahasiswa
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MahasiswaRequest $request, $kurikulum, $nim)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kurikulum, $nim)
    {
        Master_06_Mahasiswa::destroy($nim);

        return redirect()->back();
    }

    public function toggleStatus($kurikulum, $nim)
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

    public function import($kurikulum)
    {
        Excel::import(new MahasiswaImport($this->user->programStudi->id), request()->file('formFile'));

        return redirect(route('kaprodi.mahasiswa.index', ['kurikulum' => $kurikulum]))->with('success', 'All good!');
    }
}
