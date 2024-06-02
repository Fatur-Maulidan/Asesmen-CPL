<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaSheetImport implements ToModel, WithHeadingRow
{
    protected static $program_studi_id;

    public function __construct($program_studi_id)
    {
        self::$program_studi_id = $program_studi_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'email' => $row['email'],
            'kelas' => $row['kelas'],
            'tahun_angkatan' => $row['tahun_angkatan'],
            '02_MASTER_program_studi_id' => self::$program_studi_id
        ]);
    }
}
