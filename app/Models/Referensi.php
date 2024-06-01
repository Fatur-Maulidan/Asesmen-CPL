<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referensi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '11_MASTER_referensi';

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
    protected $fillable = ['judul', 'penerbit', 'tahun_terbit'];

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
    public function mataKuliahRegister()
    {
        return $this->belongsToMany(MataKuliahRegister::class, '15_MASTER_referensi_utama', '11_MASTER_referensi_id', '10_MASTER_mk_register_id');
    }

    function pengarang()
    {
        return $this->belongsToMany(Pengarang::class, '23_MASTER_pengarang_referensi', '11_MASTER_referensi_id', '23_MASTER_pengarang_id')->using(PengarangReferensi::class);
    }
}
