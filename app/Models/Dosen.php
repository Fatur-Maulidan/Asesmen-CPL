<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\PeranDosen;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dosen';

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
    protected $fillable = ['nip', 'kode', 'nama', 'jenis_kelamin', 'email', 'status', 'peran', 'kata_sandi'];

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
        'jenis_kelamin' => JenisKelamin::class,
        'status' => StatusKeaktifan::class,
        'peran' => PeranDosen::class
    ];

    // Relationship

    public function programStudi()
    {
        return $this->hasOne(ProgramStudi::class, 'dosen_id');
    }
}
