<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_18_Soal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '18_MASTER_soal';

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
    protected $fillable = ['pertanyaan', 'bentuk_evaluasi'];

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
    public function kemampuanAkhirDiharapkan()
    {
        return $this->belongsTo(Master_17_KemampuanAkhirDiharapkan::class, '17_MASTER_kad_id');
    }
}
