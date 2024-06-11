<?php

namespace App\Imports;

use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use App\Models\Master_02_ProgramStudi;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class DosenSheetImport implements OnEachRow, WithHeadingRow
{
    private $program_studi;

    public function __construct()
    {
        $this->program_studi = Master_02_ProgramStudi::select('nomor', 'nama', 'jenjang_pendidikan')->get();
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

        $prodi = $this->program_studi->where('jenjang_pendidikan', explode(' ', $row['program_studi'], 2)[0])
        ->where('nama', explode(' ', $row['program_studi'], 2)[1])->first();

        $dosen = Master_04_Dosen::updateOrCreate(['kode' => $row['kode']],
            [
            'kode' => $row['kode'],
            'nip' => $row['nip'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            '01_MASTER_jurusan_nomor' => Master_01_Jurusan::where('nama', $row['jurusan'])->pluck('nomor')->first(),
        ]);

        $dosen->programStudi()->attach($prodi);
    }
}
