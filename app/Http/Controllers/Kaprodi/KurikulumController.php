<?php

namespace App\Http\Controllers\Kaprodi;

use App\Enums\StatusKurikulum;
use App\Http\Controllers\Controller;
use App\Http\Requests\KurikulumRequest;
use App\Models\Dosen;
use App\Models\Kurikulum;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KurikulumController extends Controller
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
    public function index()
    {
        $kaprodiNip = '199301062019031017';
        $kurikulum = Kurikulum::whereHas('programStudi', function($query) use ($kaprodiNip) {
                        $query->where('koordinator_nip', $kaprodiNip);
                    })
                    ->with('programStudi')
                    ->get();

        return view('kaprodi.kurikulum.index', [
            'title' => 'Home',
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'data_kurikulum' => $kurikulum
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
            'nama' => 'Jhon Doe',
            'role' => 'Koordinator Program Studi',
            'program_studi_id' => $this->user->programStudi->id
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

        $nilai = [];
        for ($i = 0; $i < $validated['jumlah_maksimal_rubrik']; $i++) {
            $temp = [
                ($i + 1) => [
                    'makna_tingkat_kemampuan' => $validated['makna_tingkat_kemampuan'][$i],
                    'nilai' => [
                        'awal' => $validated['nilai'][$i]['a'],
                        'akhir' => $validated['nilai'][$i]['b'],
                    ]
                ]
            ];
            $nilai[$i + 1] = $temp[$i + 1];
        }

        Kurikulum::create([
            'tahun' => $validated['tahun'],
            'tahun_berlaku' => $validated['tahun'],
            'status' => StatusKurikulum::Peninjauan,
            'jumlah_maksimal_rubrik' => $validated['jumlah_maksimal_rubrik'],
            'nilai_rentang_rubrik' => $nilai,
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
        //
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