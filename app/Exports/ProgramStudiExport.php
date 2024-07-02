<?php

namespace App\Exports;

use App\Models\Master_01_Jurusan;
use App\Models\Master_02_ProgramStudi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ProgramStudiExport implements FromCollection
{
    protected $results;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $this->results = $this->getActionItems();

        return $this->results;
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {

                // get layout counts (add 1 to rows for heading row)
                $row_count = $this->results->count() + 1;
                $column_count = count($this->results[0]->toArray());

                // set dropdown column
                $drop_column = 'D';

                // set dropdown options
                $jurusan = Master_01_Jurusan::all();
                $options = [];
                foreach ($jurusan as $j) {
                    array_push($options, $j->nama);
                }

                // set dropdown list for first data row
                $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST );
                $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setShowDropDown(true);
                $validation->setErrorTitle('Input error');
                $validation->setError('Nama jurusan tidak terdaftar dalam pilihan.');
                $validation->setPromptTitle('Input nama jurusan');
                $validation->setPrompt('Dapat dipilih melalui dropdown.');
                $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                // clone validation to remaining rows
                for ($i = 3; $i <= $row_count; $i++) {
                    $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                }

                // set columns to autosize
                for ($i = 1; $i <= $column_count; $i++) {
                    $column = Coordinate::stringFromColumnIndex($i);
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
