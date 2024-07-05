<?php

namespace App\Imports;

use App\Models\Master_08_CapaianPembelajaranLulusan;
use App\Models\Master_09_IndikatorKinerja;
use App\Models\Master_10_Rubrik;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class IndikatorKinerjaImport implements OnEachRow, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;

    private $kurikulum_id;
    private $data_cpl;

    public function __construct($kurikulum_id)
    {
        $this->kurikulum_id = $kurikulum_id;
        $this->data_cpl = Master_08_CapaianPembelajaranLulusan::with('indikatorKinerja')
            ->where('03_MASTER_kurikulum_id', $this->kurikulum_id)
            ->get();
    }

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $cpl = $this->data_cpl->where('kode', $row['kode_cp'])->first();
        $exists = $cpl->indikatorKinerja->whereIn('kode', $row['kode_ik'])->values();

        if ($exists->isEmpty()) {
            DB::transaction(function () use ($row, $cpl) {
                $ik = Master_09_IndikatorKinerja::create([
                    'kode' => $row['kode_ik'],
                    'deskripsi' => $row['deskripsi_ik'],
                    '08_MASTER_capaian_pembelajaran_lulusan_id' => $cpl->id,
                ]);

                Master_10_Rubrik::create([
                    'urutan' => 1,
                    'deskripsi' => $row['rubrik_sangat_kurang'],
                    '09_MASTER_indikator_kinerja_id' => $ik->id,
                ]);

                Master_10_Rubrik::create([
                    'urutan' => 2,
                    'deskripsi' => $row['rubrik_kurang'],
                    '09_MASTER_indikator_kinerja_id' => $ik->id,
                ]);

                Master_10_Rubrik::create([
                    'urutan' => 3,
                    'deskripsi' => $row['rubrik_cukup'],
                    '09_MASTER_indikator_kinerja_id' => $ik->id,
                ]);

                Master_10_Rubrik::create([
                    'urutan' => 4,
                    'deskripsi' => $row['rubrik_baik'],
                    '09_MASTER_indikator_kinerja_id' => $ik->id,
                ]);

                Master_10_Rubrik::create([
                    'urutan' => 5,
                    'deskripsi' => $row['rubrik_sangat_baik'],
                    '09_MASTER_indikator_kinerja_id' => $ik->id,
                ]);
            });
        }
    }
}
