<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Master_12_PetaIkMk extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '12_MASTER_peta_ik_mk';

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
    protected $fillable = ['11_MASTER_mk_register_id', '09_MASTER_indikator_kinerja_id'];

    public $timestamps = false;
    // Relations
    public function tujuanPembelajaran()
    {
        return $this->belongsToMany(Master_13_TujuanPembelajaran::class, '14_MASTER_peta_ik_tp', '12_MASTER_peta_ik_mk_id', '13_MASTER_tujuan_pembelajaran_id')->withPivot('bobot_tp');
    }
}
