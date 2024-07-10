<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master_14_PetaIkTp extends Model
{
    use HasFactory;

    protected $table = '14_MASTER_peta_ik_tp';

    protected $fillable = [
        '12_MASTER_peta_ik_mk_id',
        '13_MASTER_tujuan_pembelajaran_id',
        'bobot_tp'
    ];
    public $timestamps = false;
}
