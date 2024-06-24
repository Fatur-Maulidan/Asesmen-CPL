<?php

namespace App\Imports;

use App\Models\Master_08_CapaianPembelajaranLulusan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CapaianPembelajaranLulusanImport implements ToModel, WithHeadingRow, SkipsOnError
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
        return new Master_08_CapaianPembelajaranLulusan([
            'kode' => $row['kode'],
            'domain' => $row['domain'],
            'deskripsi' => $row['deskripsi'],
            '03_MASTER_kurikulum_id' => $this->kurikulum_id,
        ]);
    }
}
