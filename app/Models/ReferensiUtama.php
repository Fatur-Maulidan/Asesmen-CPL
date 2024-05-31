<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ReferensiUtama extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '15_MASTER_referensi_utama';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['07_MASTER_capaian_pembelajaran_lulusan_id', '08_MASTER_indikator_kinerja_id'];
}
