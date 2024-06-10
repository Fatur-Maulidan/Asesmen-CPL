<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_17_KemampuanAkhirDiharapkan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '17_MASTER_kad';

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
    protected $fillable = ['deskripsi', 'materi', 'minggu', 'persentase_kontribusi_tp', '13_MASTER_tujuan_pembelajaran_id'];

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
    public function tujuanPembelajaran()
    {
        return $this->belongsTo(Master_13_TujuanPembelajaran::class, '13_MASTER_tujuan_pembelajaran_id');
    }

    public function soal()
    {
        return $this->hasMany(Master_18_Soal::class, '17_MASTER_kad_id');
    }
}
