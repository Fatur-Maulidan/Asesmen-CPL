<?php

namespace App\Models;

use App\Enums\StatusMataKuliah;
use Illuminate\Database\Eloquent\Model;

class MataKuliahRegister extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '10_MASTER_mk_register';

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
    protected $fillable = ['tahun_akademik', 'semester', 'status', '06_MASTER_mata_kuliah_id'];

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
        'status' => StatusMataKuliah::class
    ];

    // Relationship
    public function dosen()
    {
        return $this->belongsToMany(Dosen::class, '14_MASTER_perkuliahan', '10_MASTER_mk_register_id', '04_MASTER_dosen_nip')->using(Perkuliahan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, '14_MASTER_perkuliahan', '10_MASTER_mk_register_id', '05_MASTER_mahasiswa_nim')->using(Perkuliahan::class);
    }

    public function referensi()
    {
        return $this->belongsToMany(Referensi::class, '15_MASTER_referensi_utama', '10_MASTER_mk_register_id', '11_MASTER_referensi_id');
    }

    public function petaCpIk()
    {
        return $this->belongsToMany(PetaCpIk::class, '17_MASTER_peta_ik_mk_tp', '10_MASTER_mk_register_id', '13_MASTER_peta_cp_ik_id')->using(PetaIkMkTp::class);
    }

    public function tujuanPembelajaran()
    {
        return $this->belongsToMany(TujuanPembelajaran::class, '17_MASTER_peta_ik_mk_tp', '10_MASTER_mk_register_id', '16_MASTER_tujuan_pembelajaran_id')->using(PetaIkMkTp::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, '06_MASTER_mata_kuliah_id');
    }
}
