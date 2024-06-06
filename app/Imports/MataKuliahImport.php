<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataKuliahImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;

    private $kurikulum_id;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MataKuliah([
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'deskripsi' => $row['deskripsi'],
            'jumlah_sks' => $row['jumlah_sks'],
            '03_MASTER_kurikulum_id' => $this->kurikulum_id,
        ]);
    }
}
