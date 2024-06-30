<?php

namespace App\Models;

use App\Enums\DomainCPL;
use Illuminate\Database\Eloquent\Model;

class Master_08_CapaianPembelajaranLulusan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '08_MASTER_capaian_pembelajaran_lulusan';

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
    protected $fillable = ['kode', 'domain', 'deskripsi', '03_MASTER_kurikulum_id'];

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
        'domain' => DomainCPL::class
    ];

    // # Relations
    public function kurikulum()
    {
        return $this->belongsTo(Master_03_Kurikulum::class, '03_MASTER_kurikulum_id');
    }

    public function indikatorKinerja()
    {
        return $this->hasMany(Master_09_IndikatorKinerja::class, '08_MASTER_capaian_pembelajaran_lulusan_id');
    }

    public function ketercapaian()
    {
        return $this->hasMany(Analisis_01_Ketercapaian_Mahasiswa::class, 'id_cpl');
    }

    // # Methods
    public function getCplIdByKurikulum($kode, $kurikulum)
    {
        return $this->where('kode',$kode)
                    ->where('03_MASTER_kurikulum_id', $kurikulum)->first();
    }
}
