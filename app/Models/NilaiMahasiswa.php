<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NilaiMahasiswa extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '18_MASTER_nilai_mahasiswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['05_MASTER_mahasiswa_nim', '09_MASTER_rencana_asesmen_id', 'nilai_ra'];
}
