<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProgramStudiImport implements WithMultipleSheets
{
    use Importable;

    protected $schema = [];

    public function __construct()
    {
        $this->schema['Sheet1'] = new ProgramStudiSheetImport();
    }

    public function sheets(): array
    {
        return $this->schema;
    }
}
