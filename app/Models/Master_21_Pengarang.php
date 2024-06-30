<?php

namespace App\Models;

use App\Http\Middleware\TrustProxies;
use Illuminate\Database\Eloquent\Model;

class Master_21_Pengarang extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '21_MASTER_pengarang';

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
    protected $fillable = ['nama_depan', 'nama_belakang'];

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
    public function referensi()
    {
        return $this->belongsToMany(Master_20_Referensi::class, '22_MASTER_referensi_register', '21_MASTER_pengarang_id', '20_MASTER_referensi_id');
    }
}
