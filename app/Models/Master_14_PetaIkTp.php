<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_14_PetaIkTp extends Model
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
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['12_MASTER_tujuan_pembelajaran_id', '11_MASTER_peta_ik_mk_id', 'bobot_tp'];
}
