<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaAsesmen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '09_MASTER_rencana_asesmen';

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
    protected $fillable = ['kategori', 'kode', 'minggu'];

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
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, '18_MASTER_nilai_mahasiswa', '09_MASTER_rencana_asesmen_id', '05_MASTER_mahasiswa_nim')->using(NilaiMahasiswa::class)->withTimestamps();
    }

    public function tujuanPembelajaran()
    {
        return $this->belongsToMany(TujuanPembelajaran::class, '21_MASTER_peta_ra_tp', '09_MASTER_rencana_asesmen_id', '16_MASTER_tujuan_pembelajaran_id')->using(PetaRaTp::class);
    }
}
