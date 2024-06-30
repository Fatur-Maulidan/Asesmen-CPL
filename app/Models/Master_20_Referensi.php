<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_20_Referensi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '20_MASTER_referensi';

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
    public $timestamps = true;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    // Relations
    public function pengarang()
    {
        return $this->belongsToMany(Master_21_Pengarang::class, '22_MASTER_referensi_register', '20_MASTER_referensi_id', '21_MASTER_pengarang_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(Master_11_MataKuliahRegister::class, '23_MASTER_referensi_utama', '20_MASTER_referensi_id', '11_MASTER_mk_register_id');
    }
}
