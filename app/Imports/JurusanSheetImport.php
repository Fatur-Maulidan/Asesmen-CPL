<?php

namespace App\Imports;

use App\Models\Master_01_Jurusan;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Master_01_Jurusan([
            'nama' => $row['nama_jurusan'],
            'kategori' => $row['kategori_jurusan']
        ]);
    }
}
