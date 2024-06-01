<?php

namespace App\Models;

use App\Enums\JenjangPendidikan;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '02_MASTER_program_studi';

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
    protected $fillable = ['nomor', 'nama', 'kode', 'jenjang_pendidikan', '01_MASTER_jurusan_id', 'koordinator_nip'];

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
        'jenjang_pendidikan' => JenjangPendidikan::class
    ];

    // Relationship
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, '01_MASTER_jurusan_id');
    }

    public function kurikulum()
    {
        return $this->hasMany(Kurikulum::class, '02_MASTER_program_studi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'koordinator_nip');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, '02_MASTER_program_studi_id');
    }
}
