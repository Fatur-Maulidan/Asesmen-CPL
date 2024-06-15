<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_22_Referensi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '22_MASTER_referensi';

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
    protected $fillable = ['judul', 'tahun_terbit'];

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
    public function pengarang()
    {
        return $this->belongsToMany(Master_23_Pengarang::class, '24_MASTER_referensi_register', '22_MASTER_referensi_id', '23_MASTER_pengarang_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(Master_11_MataKuliahRegister::class, '25_MASTER_referensi_utama', '22_MASTER_referensi_id', '23_MASTER_mk_register_id');
    }
}