<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaImport implements WithMultipleSheets
{
    protected static $program_studi_id;

    public function __construct($program_studi_id = null)
    {
        self::$program_studi_id = $program_studi_id;
    }

    public function sheets(): array
    {
        return [
            new MahasiswaSheetImport(self::$program_studi_id)
        ];
    }
}
