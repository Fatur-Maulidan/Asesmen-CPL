<?php

namespace App\Models;

use App\Enums\JurusanGolongan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jurusan';

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
    protected $fillable = ['nama', 'golongan'];

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
    protected $casts = [
        'golongan' => JurusanGolongan::class,
    ];

    // Relationships

    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'jurusan_id');
    }

    // Scope

    public function scopeRekayasa($query)
    {
        return $query->where('golongan', 'Rekayasa');
    }

    public function scopeNonRekayasa($query)
    {
        return $query->where('golongan', 'Non Rekayasa');
    }

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('nama', 'like', '%' . request('search') . '%');
        }
    }
}
