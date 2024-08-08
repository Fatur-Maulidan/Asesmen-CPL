<?php

namespace App\Imports;

use App\Models\Master_01_Jurusan;
use App\Models\Master_02_ProgramStudi;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProgramStudiSheetImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    private $jurusan;
    private $program_studi;

    public function __construct()
    {
        $this->jurusan = Master_01_Jurusan::select('id', 'nama')->get();
        $this->program_studi = Master_02_ProgramStudi::select('kode')->get();
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $exist = $this->program_studi->where('kode', $row['kode_program_studi'])->first();
        if (!$exist) {
            return new Master_02_ProgramStudi([
                'nama' => $row['nama_program_studi'],
                'kode' => $row['kode_program_studi'],
                'jenjang_pendidikan' => $row['jenjang_pendidikan'],
                '01_MASTER_jurusan_id' => $this->jurusan->where('nama', $row['nama_jurusan'])->pluck('id')->first(),
            ]);
        } else null;
    }
}
