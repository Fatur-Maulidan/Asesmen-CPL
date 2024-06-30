<?php

namespace App\Models;

use App\Enums\JenjangPendidikan;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Model;

class Master_02_ProgramStudi extends Model
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
    protected $fillable = ['nama', 'kode', 'jenjang_pendidikan', '01_MASTER_jurusan_id', '04_MASTER_dosen_kode'];

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

    // # Relations
    public function jurusan()
    {
        return $this->belongsTo(Master_01_Jurusan::class, '01_MASTER_jurusan_id');
    }

    public function kurikulum()
    {
        return $this->hasMany(Master_03_Kurikulum::class, '02_MASTER_program_studi_id');
    }

    public function kaprodi()
    {
        return $this->belongsTo(Master_04_Dosen::class, '04_MASTER_dosen_kode');
    }

    public function dosen()
    {
        return $this->belongsToMany(Master_04_Dosen::class, '05_MASTER_prodi_dosen', '02_MASTER_program_studi_id', '04_MASTER_dosen_kode');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Master_06_Mahasiswa::class, '02_MASTER_program_studi_id');
    }

    // # Methods
    public function kurikulumAktif()
    {
        return $this->kurikulum()->aktif();
    }
}
