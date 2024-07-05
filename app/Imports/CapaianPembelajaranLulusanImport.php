<?php

namespace App\Imports;

use App\Models\Master_08_CapaianPembelajaranLulusan;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class CapaianPembelajaranLulusanImport implements OnEachRow, WithHeadingRow, SkipsOnError
{
    private $kurikulum_id;
    private $cpl;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
        $this->cpl = Master_08_CapaianPembelajaranLulusan::where('03_MASTER_kurikulum_id', $this->kurikulum_id)->get();
    }

    use Importable, SkipsErrors;

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $exist = $this->cpl->where('kode', $row['kode'])->first();
        if (!$exist) {
            Master_08_CapaianPembelajaranLulusan::create([
                'kode' => $row['kode'],
                'domain' => $row['domain'],
                'deskripsi' => $row['deskripsi'],
                '03_MASTER_kurikulum_id' => $this->kurikulum_id,
            ]);
        }
    }
}
