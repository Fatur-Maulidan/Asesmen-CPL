<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorKinerja extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '08_MASTER_indikator_kinerja';

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
    protected $fillable = ['kode', 'deskripsi'];

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
    public function capaianPembelajaranLulusan()
    {
        return $this->belongsToMany(CapaianPembelajaranLulusan::class, '13_MASTER_peta_cp_ik', '08_MASTER_indikator_kinerja_id', '07_MASTER_capaian_pembelajaran_lulusan_id')->using(PetaCpIk::class);
    }

    public function rubrik()
    {
        return $this->hasMany(Rubrik::class, '08_MASTER_indikator_kinerja_id');
    }
}
