<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Master_14_PetaIkTp extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '14_MASTER_peta_ik_tp';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['13_MASTER_tujuan_pembelajaran_id', '12_MASTER_peta_ik_mk_id', 'bobot_tp'];
}
