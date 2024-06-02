<?php

namespace App\Imports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanSheetImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Jurusan([
            'nama' => $row['nama_jurusan'],
            'golongan' => $row['golongan']
        ]);
    }
}
