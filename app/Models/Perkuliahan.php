<?php

namespace App\Models;

use App\Enums\JenisPerkuliahan;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Perkuliahan extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '14_MASTER_perkuliahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['04_MASTER_dosen_nip', '05_MASTER_mahasiswa_nip', '10_MASTER_mk_register_id', 'kelas_ajar', 'jenis'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'jenis' => JenisPerkuliahan::class
    ];
}
