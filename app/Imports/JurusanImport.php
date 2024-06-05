<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JurusanImport implements WithMultipleSheets
{
    use Importable;

    public function sheets(): array
    {
        return [
            new JurusanSheetImport()
        ];
    }
}
