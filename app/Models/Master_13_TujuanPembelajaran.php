<?php

namespace App\Models;

use App\Enums\StatusValidasiTP;
use Illuminate\Database\Eloquent\Model;

class Master_13_TujuanPembelajaran extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '13_MASTER_tujuan_pembelajaran';

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
    protected $fillable = ['kode', 'deskripsi', 'tanggal_divalidasi', 'status_validasi', 'alasan_penolakan', '11_MASTER_mk_register_id'];

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
    protected $casts = [
        'tanggal_divalidasi' => 'datetime',
        'status_validasi' => StatusValidasiTP::class
    ];

    // Relations
    public function mataKuliahRegister()
    {
        return $this->belongsTo(Master_11_MataKuliahRegister::class, '11_MASTER_mk_register_id');
    }

    public function petaIkMk()
    {
        return $this->belongsToMany(Master_12_PetaIkMk::class, '14_MASTER_peta_ik_tp', '13_MASTER_tujuan_pembelajaran_id', '12_MASTER_peta_ik_mk_id')->withPivot('bobot_tp');
    }

    public function rencanaAsesmen()
    {
        return $this->belongsToMany(Master_15_RencanaAsesmen::class, '16_MASTER_peta_ra_tp', '13_MASTER_tujuan_pembelajaran_id', '15_MASTER_rencana_asesmen_id');
    }

    public function kemampuanAkhirDiharapkan()
    {
        return $this->hasMany(Master_17_KemampuanAkhirDiharapkan::class, '13_MASTER_tujuan_pembelajaran_id');
    }
}
