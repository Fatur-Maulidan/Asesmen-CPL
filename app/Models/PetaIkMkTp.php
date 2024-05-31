<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PetaIkMkTp extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '17_MASTER_peta_ik_mk_tp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['10_MASTER_mk_register_id', '13_MASTER_peta_cp_ik_id', '16_MASTER_tujuan_pembelajaran_id', 'bobot_tp'];
}
