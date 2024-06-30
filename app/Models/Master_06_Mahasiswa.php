<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Model;

class Master_06_Mahasiswa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '06_MASTER_mahasiswa';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nim';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

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
    protected $fillable = ['nim', 'nama', 'email', 'jenis_kelamin', 'kelas', 'tahun_angkatan', 'status', '02_MASTER_program_studi_id', '03_MASTER_kurikulum_id'];

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
        'jenis_kelamin' => JenisKelamin::class,
        'status' => StatusKeaktifan::class,
    ];

    // # Relations
    public function programStudi()
    {
        return $this->belongsTo(Master_02_ProgramStudi::class, '02_MASTER_program_studi_id');
    }

    public function kurikulum()
    {
        return $this->belongsTo(Master_03_Kurikulum::class, '03_MASTER_kurikulum_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(Master_11_MataKuliahRegister::class, '18_MASTER_perkuliahan', '06_MASTER_mahasiswa_nim', '11_MASTER_mk_register_id');
    }

    public function rencanaAsesmen()
    {
        return $this->belongsToMany(Master_15_RencanaAsesmen::class, '19_MASTER_nilai_mahasiswa', '06_MASTER_mahasiswa_nim', '15_MASTER_rencana_asesmen_id')->withPivot('nilai')->withTimestamps();
    }

    public function ketercapaian()
    {
        return $this->hasMany(Analisis_01_Ketercapaian_Mahasiswa::class, 'nim');
    }

    // # Scopes
}
