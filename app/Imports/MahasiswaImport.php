<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaImport implements WithMultipleSheets
{
    private $program_studi_id;
    private $kurikulum_id;

    public function __construct($program_studi_id, $kurikulum_id)
    {
        $this->program_studi_id = $program_studi_id;
        $this->kurikulum_id = $kurikulum_id;
    }

    public function sheets(): array
    {
        return [
            new MahasiswaSheetImport($this->program_studi_id, $this->kurikulum_id)
        ];
    }
}
