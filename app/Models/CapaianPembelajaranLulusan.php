<?php

namespace App\Models;

use App\Enums\DomainCPL;
use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaranLulusan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '07_MASTER_capaian_pembelajaran_lulusan';

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
    protected $fillable = ['kode', 'deskripsi', 'domain', '03_MASTER_kurikulum_id'];

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

    // Relationship
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, '03_MASTER_kurikulum_id');
    }

    public function indikatorKinerja()
    {
        return $this->belongsToMany(IndikatorKinerja::class, '13_MASTER_peta_cp_ik', '07_MASTER_capaian_pembelajaran_lulusan_id', '08_MASTER_indikator_kinerja_id')->using(PetaCpIk::class);
    }

    
}
