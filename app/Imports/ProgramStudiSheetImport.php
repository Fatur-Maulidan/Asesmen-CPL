<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\ProgramStudi;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgramStudiSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProgramStudi([
            'nomor' => $row['nomor'],
            'nama' => $row['nama'],
            'kode' => $row['kode'],
            'jenjang_pendidikan' => $row['jenjang_pendidikan'],
            '01_MASTER_jurusan_id' => Jurusan::where('nama', $row['jurusan'])->pluck('id')->first(),
        ]);
    }
}
