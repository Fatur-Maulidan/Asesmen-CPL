<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '22_MASTER_pengarang';

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
    protected $fillable = ['nama'];

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
    function referensi()
    {
        return $this->belongsToMany(Referensi::class, '23_MASTER_pengarang_referensi', '23_MASTER_pengarang_id', '11_MASTER_referensi_id')->using(PengarangReferensi::class);
    }
}
