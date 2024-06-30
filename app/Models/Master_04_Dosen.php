<?php

namespace App\Models;

use App\Enums\JenisKelamin;
use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Eloquent\Model;

class Master_04_Dosen extends Model
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
    protected $primaryKey = 'kode';

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
    protected $fillable = ['kode', 'nip', 'nama', 'email', 'kata_sandi', 'jenis_kelamin', 'status', '01_MASTER_jurusan_id'];

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
    public function jurusan()
    {
        return $this->belongsTo(Master_01_Jurusan::class, '01_MASTER_jurusan_id');
    }

    public function kaprodi()
    {
        return $this->hasOne(Master_02_ProgramStudi::class, '04_MASTER_dosen_kode');
    }

    public function programStudi()
    {
        return $this->belongsToMany(Master_02_ProgramStudi::class, '05_MASTER_prodi_dosen', '04_MASTER_dosen_kode', '02_MASTER_program_studi_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(Master_11_MataKuliahRegister::class, '17_MASTER_pengampu', '04_MASTER_dosen_kode', '11_MASTER_mk_register_id');
    }

    // # Methods
    public function getProdiKodeByDosenNip($nip){
        return $this->with('kaprodi')->where('nip',$nip)->first();
    }

    public function getDosenByNip($nip){
        return $this->where('nip',$nip)->with('programStudi')->first();
    }

    // Method ini digunakan untuk mengambil mata kuliah yang diampu oleh seorang dosen
    // public function getMataKuliahRegister($nip){
    //     return $this->where('nip',$nip)->with(['mataKuliahRegister' => function($query) {
    //         $query->distinct('06_MASTER_mata_kuliah_id');
    //     }])->first();
    // }

    public function getMataKuliahRegister($kurikulum){
        return $this->where('03_MASTER_kurikulum_id',$kurikulum)->with('mataKuliahRegister')->get();
    }
}
