<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '20_MASTER_soal';

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
    protected $fillable = ['nomor', 'deskripsi'];

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
    public function kemampuanAkhir()
    {
        return $this->belongsTo(KemampuanAkhir::class, '19_MASTER_kemampuan_akhir');
    }
}
