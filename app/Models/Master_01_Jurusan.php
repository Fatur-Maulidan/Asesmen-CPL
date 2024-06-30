<?php

namespace App\Models;

use App\Enums\KategoriJurusan;
use Illuminate\Database\Eloquent\Model;

class Master_01_Jurusan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '01_MASTER_jurusan';

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
    protected $fillable = ['nama', 'kategori'];

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
        'kategori' => KategoriJurusan::class,
    ];

    // # Relations
    public function programStudi()
    {
        return $this->hasMany(Master_02_ProgramStudi::class, '01_MASTER_jurusan_id');
    }

    public function dosen()
    {
        return $this->hasMany(Master_04_Dosen::class, '01_MASTER_jurusan_id');
    }

    // # Scopes
    public function scopeRekayasa($query)
    {
        return $query->where('kategori', 'Rekayasa');
    }

    public function scopeNonrekayasa($query)
    {
        return $query->where('kategori', 'Nonrekayasa');
    }

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('nama', 'like', '%' . request('search') . '%');
        }
    }
}
