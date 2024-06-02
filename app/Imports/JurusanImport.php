<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JurusanImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new JurusanSheetImport()
        ];
    }
}
