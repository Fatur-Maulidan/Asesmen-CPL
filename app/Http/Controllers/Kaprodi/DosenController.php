<?php

namespace App\Http\Controllers\Kaprodi;

use App\DataTables\DosenDataTable;
use App\Enums\StatusKeaktifan;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Master_04_Dosen::with('kaprodi')->find('KO042N');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DosenDataTable $dataTable, $kurikulum)
    {
        return $dataTable->with(['kaprodi' => true, 'jurusan_nomor' => $this->user->jurusan->nomor])
            ->render('kaprodi.dosen.index', [
            'title' => 'Dosen',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'kurikulum' => $kurikulum,
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
    public function show($kurikulum, $nip)
    {
        if (request()->ajax()) {
            $dosen = Master_04_Dosen::find($nip);

            return response()->json([
                'dosen' => $dosen
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
    public function update(DosenRequest $request, $kurikulum, $nip)
    {
        $dosen = Master_04_Dosen::find($nip);

        if ($request->ajax()) {
            $validated = $request->validated();

            $dosen->update($validated);

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
    public function destroy($kurikulum, $nip)
    {
        Master_04_Dosen::destroy($nip);

        return redirect()->back();
    }

    public function toggleStatus($nip)
    {
        $dosen = Master_04_Dosen::find($nip);

        $dosen->update([
            'status' => ($dosen->status->is(StatusKeaktifan::Aktif)) ? StatusKeaktifan::Nonaktif : StatusKeaktifan::Aktif
        ]);

        return redirect()->back();
    }
}
