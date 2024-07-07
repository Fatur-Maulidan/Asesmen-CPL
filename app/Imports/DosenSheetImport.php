<?php

namespace App\Imports;

use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use App\Models\Master_02_ProgramStudi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class DosenSheetImport implements OnEachRow, WithHeadingRow
{
    private $jurusan;
    private $program_studi;

    public function __construct()
    {
        $this->jurusan = Master_01_Jurusan::select('id', 'nama')->get();
        $this->program_studi = Master_02_ProgramStudi::select('id', 'nama', 'jenjang_pendidikan')->get();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $data = [
            'kode' => $row['kode_dosen'],
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'jenis_kelamin' => $row['jenis_kelamin'],
        ];

        if (Auth::user()->hasRole('admin')) {
            $data['01_MASTER_jurusan_id'] = $this->jurusan->where('nama', $row['homebase_jurusan'])->pluck('id')->first();
        } else if (Auth::user()->hasRole('koordinator program studi')) {
            $data['01_MASTER_jurusan_id'] = Auth::user()->jurusan->id;
        }

        $dosen = Master_04_Dosen::where('kode', $row['kode_dosen'])->first();
        if ($dosen) {
            $dosen->update($data);
        } else {
            $dosen = Master_04_Dosen::create($data);
        }

        $program_studi = explode(',', $row['program_studi_mengajar']);
        $prodi = [];
        foreach ($program_studi as $ps) {
            $temp = $this->program_studi->where('jenjang_pendidikan', explode(' ', trim($ps), 2)[0])
                ->where('nama', explode(' ', trim($ps), 2)[1])->pluck('id')->first();

            $prodi[] = $temp;
        }

        $dosen->programStudi()->sync($prodi);
        $dosen->assignRole('dosen');
    }
}
