<?php

namespace App\Imports;

use App\Models\Master_04_Dosen;
use App\Models\Master_01_Jurusan;
use App\Models\Master_02_ProgramStudi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenSheetImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Master_04_Dosen([
            'nip' => $row['nip'],
            'kode' => $row['kode'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'role' => $row['role'],
            '01_MASTER_jurusan_id' => Master_01_Jurusan::where('nama', $row['jurusan'])->pluck('id')->first(),
            '02_MASTER_program_studi_id' => Master_02_ProgramStudi::where('jenjang_pendidikan', explode(" ", $row['program_studi'], 2)[0])
                ->where('nama', explode(" ", $row['program_studi'], 2)[1])->pluck('id')->first()
        ]);
    }
}
