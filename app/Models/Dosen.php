<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '04_MASTER_dosen';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nip';

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
    protected $fillable = ['nip', 'kode', 'nama', 'email', 'jenis_kelamin', 'role', 'status', 'kata_sandi', '01_MASTER_jurusan_id', '02_MASTER_program_studi_id'];

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
        'role' => RoleDosen::class,
        'status' => StatusKeaktifan::class,
    ];

    // Relationship
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, '01_MASTER_jurusan_id');
    }

    public function kaprodi()
    {
        return $this->hasOne(ProgramStudi::class, 'koordinator_nip');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, '02_MASTER_program_studi_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(MataKuliahRegister::class, '14_MASTER_perkuliahan', '04_MASTER_dosen_nip', '10_MASTER_mk_register_id')->using(Perkuliahan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, '14_MASTER_perkuliahan', '04_MASTER_dosen_nip', '05_MASTER_mahasiswa_nim')->using(Perkuliahan::class);
    }

    public function getProdiIdByDosenNip($nip){
        return $this->with('programStudi:id,koordinator_nip')->find($nip);
    }

    // Method ini digunakan untuk mengambil mata kuliah yang diampu oleh seorang dosen
    public function getMataKuliahRegister($nip){
        return $this->where('nip',$nip)->with(['mataKuliahRegister' => function($query) {
            $query->distinct('06_MASTER_mata_kuliah_id');
        }])->first();
    }
}
