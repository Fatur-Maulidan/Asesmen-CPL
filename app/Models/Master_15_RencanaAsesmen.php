<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_15_RencanaAsesmen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '15_MASTER_rencana_asesmen';

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
    protected $fillable = ['kode', 'kategori', 'minggu', '11_MASTER_mk_register_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    // Relations
    public function mataKuliahRegister()
    {
        return $this->belongsTo(Master_11_MataKuliahRegister::class, '11_MASTER_mk_register_id');
    }

    public function tujuanPembelajaran()
    {
        return $this->belongsToMany(Master_13_TujuanPembelajaran::class, '16_MASTER_peta_ra_tp', '15_MASTER_rencana_asesmen_id', '13_MASTER_tujuan_pembelajaran_id');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Master_06_Mahasiswa::class, '21_MASTER_nilai_mahasiswa', '15_MASTER_rencana_asesmen_id', '06_MASTER_mahasiswa_nim')->withPivot('nilai')->withTimestamps();
    }
}
