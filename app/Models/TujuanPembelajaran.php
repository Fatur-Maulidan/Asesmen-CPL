<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '16_MASTER_tujuan_pembelajaran';

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
    protected $fillable = ['kode', 'deskripsi', 'tanggal_diajukan', 'tanggal_divalidasi', 'alasan_penolakan'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    // Relationship
    public function petaCpIk()
    {
        return $this->belongsToMany(PetaCpIk::class, '17_MASTER_peta_ik_mk_tp', '16_MASTER_tujuan_pembelajaran_id', '13_MASTER_peta_cp_ik_id')->using(PetaIkMkTp::class);
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(MataKuliahRegister::class, '17_MASTER_peta_ik_mk_tp', '16_MASTER_tujuan_pembelajaran_id', '10_MASTER_mk_register_id')->using(PetaIkMkTp::class);
    }

    public function kemampuanAkhir()
    {
        return $this->hasMany(KemampuanAkhir::class, '16_MASTER_tujuan_pembelajaran_id');
    }

    public function rencanaAsesmen()
    {
        return $this->belongsToMany(RencanaAsesmen::class, '21_MASTER_peta_ra_tp', '21_MASTER_peta_ra_tp', '09_MASTER_rencana_asesmen_id')->using(PetaRaTp::class);
    }
}
