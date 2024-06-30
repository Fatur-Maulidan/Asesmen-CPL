<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_10_Rubrik extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '10_MASTER_rubrik';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = null;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['urutan', 'deskripsi', '09_MASTER_indikator_kinerja_id'];

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

    // Relation
    public function indikatorKinerja()
    {
        return $this->belongsTo(Master_09_IndikatorKinerja::class, '09_MASTER_indikator_kinerja_id');
    }
}
