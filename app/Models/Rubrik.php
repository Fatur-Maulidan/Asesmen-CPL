<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubrik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '12_MASTER_rubrik';

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
    protected $fillable = ['urutan', 'level_kemampuan', 'deskripsi', '08_MASTER_indikator_kinerja_id'];

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
    public function indikatorKinerja()
    {
        return $this->belongsTo(IndikatorKinerja::class, '08_MASTER_indikator_kinerja_id');
    }
}
