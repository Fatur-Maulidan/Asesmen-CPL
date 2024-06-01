<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KemampuanAkhir extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '19_MASTER_kemampuan_akhir';

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
    protected $fillable = ['deskripsi', 'materi', 'minggu', 'kriteria', '16_MASTER_tujuan_pembelajaran_id'];

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

    // Relationship
    public function tujuanPembelajaran()
    {
        return $this->belongsTo(TujuanPembelajaran::class, '16_MASTER_tujuan_pembelajaran_id');
    }

    public function soal()
    {
        return $this->hasMany(Soal::class, '19_MASTER_kemampuan_akhir');
    }
}
