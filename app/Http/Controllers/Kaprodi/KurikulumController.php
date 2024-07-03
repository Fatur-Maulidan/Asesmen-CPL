<?php

namespace App\Http\Controllers\Kaprodi;

use App\Enums\StatusKurikulum;
use App\Http\Controllers\Controller;
use App\Http\Requests\KurikulumRequest;
use App\Models\Master_04_Dosen;
use App\Models\Master_03_Kurikulum;
use App\Models\Master_06_Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kurikulum = Master_03_Kurikulum::with('mahasiswa')
            ->where('02_MASTER_program_studi_id', Auth::user()->kaprodi->id);

        if (request('filter') == 'aktif') {
            $kurikulum->aktif();
        } elseif (request('filter') == 'berjalan') {
            $kurikulum->berjalan();
        } elseif (request('filter') == 'pengelolaan') {
            $kurikulum->pengelolaan();
        } else {
            $kurikulum->search();
        }

        return view('kaprodi.kurikulum.index', [
            'title' => 'Home',
            'kurikulum' => $kurikulum->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kaprodi.kurikulum.create', [
            'title' => 'Tambah Kurikulum Baru',
            'program_studi_id' => Auth::user()->kaprodi->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KurikulumRequest $request)
    {
        $validated = $request->validated();

        Master_03_Kurikulum::create([
            'tahun' => $validated['tahun'],
            'tahun_berlaku' => $validated['tahun'],
            'status' => StatusKurikulum::Pengelolaan,
            'konf_tenggat_waktu_tp' => $validated['tenggat_tp'],
            'threshold' => $validated['threshold'],
            '02_MASTER_program_studi_id' => $validated['program_studi_id']
        ]);

        return redirect()->to(route('kaprodi.kurikulum.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $kurikulum = Master_03_Kurikulum::find($id);

        $kurikulum->update($request->except('_method', '_token'));

        return redirect()->to(route('kaprodi.kurikulum.index'));
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
