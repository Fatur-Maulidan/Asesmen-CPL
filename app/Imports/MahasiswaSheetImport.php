<?php

namespace App\Imports;

use App\Models\Master_06_Mahasiswa;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;

    private $program_studi_id;
    private $kurikulum_id;

    public function __construct($program_studi_id, $kurikulum_id)
    {
        $this->program_studi_id = $program_studi_id;
        $this->kurikulum_id = $kurikulum_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Master_06_Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'email' => $row['email'],
            'kelas' => $row['kelas'],
            'tahun_angkatan' => $row['tahun_angkatan'],
            '02_MASTER_program_studi_id' => $this->program_studi_id,
            '03_MASTER_kurikulum_id' => $this->kurikulum_id
        ]);
    }
}
