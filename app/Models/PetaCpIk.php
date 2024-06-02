<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PetaCpIk extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '13_MASTER_peta_cp_ik';

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

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['07_MASTER_capaian_pembelajaran_lulusan_id', '08_MASTER_indikator_kinerja_id'];

    // Relationship
    public function mataKuliahRegister()
    {
        return $this->belongsToMany(MataKuliahRegister::class, '17_MASTER_peta_ik_mk_tp', '13_MASTER_peta_cp_ik_id', '10_MASTER_mk_register_id')->using(PetaIkMkTp::class);
    }

    public function tujuanPembelajaran()
    {
        return $this->belongsToMany(TujuanPembelajaran::class, '17_MASTER_peta_ik_mk_tp', '13_MASTER_peta_cp_ik_id', '16_MASTER_tujuan_pembelajaran_id')->using(PetaIkMkTp::class);
    }
}
