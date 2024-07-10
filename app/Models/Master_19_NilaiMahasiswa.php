<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_19_NilaiMahasiswa extends Model
{
    protected $table = '19_MASTER_nilai_mahasiswa';
    public $incrementing = false;
    protected $fillable = [
        '06_MASTER_mahasiswa_nim',
        '15_MASTER_rencana_asesmen_id',
        'nilai'
    ];
}
