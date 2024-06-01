<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '05_MASTER_mahasiswa';

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
    protected $fillable = ['nim', 'nama', 'jenis_kelamin', 'email', 'kelas', 'tahun_angkatan', 'status', '02_MASTER_program_studi_id'];

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

    // Relationship
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, '02_MASTER_program_studi_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(MataKuliahRegister::class, '14_MASTER_perkuliahan', '05_MASTER_mahasiswa_nim', '10_MASTER_mk_register_id')->using(Perkuliahan::class);
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, '14_MASTER_perkuliahan', '05_MASTER_mahasiswa_nim', '04_MASTER_dosen_nip')->using(Perkuliahan::class);
    }

    public function rencanaAsesmen()
    {
        return $this->belongsToMany(RencanaAsesmen::class, '18_MASTER_nilai_mahasiswa', '05_MASTER_mahasiswa_nim', '09_MASTER_rencana_asesmen_id')->using(NilaiMahasiswa::class)->withTimestamps();
    }
}
