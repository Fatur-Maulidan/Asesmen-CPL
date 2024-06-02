<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenSheetImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dosen([
            'nip' => $row['nip'],
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'role' => $row['role'],
            '01_MASTER_jurusan_id' => Jurusan::where('nama', $row['jurusan'])->pluck('id')->first(),
        ]);
    }
}
