<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PetaRaTp extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '21_MASTER_peta_ra_tp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['09_MASTER_rencana_asesmen_id', '16_MASTER_tujuan_pembelajaran_id'];
}
