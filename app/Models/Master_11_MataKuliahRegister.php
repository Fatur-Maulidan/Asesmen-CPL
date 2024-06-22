<?php

namespace App\Models;

use App\Enums\JenisPerkuliahan;
use App\Enums\StatusMataKuliah;
use Illuminate\Database\Eloquent\Model;

class Master_11_MataKuliahRegister extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '11_MASTER_mk_register';

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
    protected $fillable = ['tahun_akademik', 'semester', 'jenis', '07_MASTER_mata_kuliah_id'];

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
        'jenis' => JenisPerkuliahan::class
    ];

    // Relations
    public function mataKuliah()
    {
        return $this->belongsTo(Master_07_MataKuliah::class, '07_MASTER_mata_kuliah_id');
    }

    public function indikatorKinerja()
    {
        return $this->belongsToMany(Master_09_IndikatorKinerja::class, '12_MASTER_peta_ik_mk', '11_MASTER_mk_register_id', '09_MASTER_indikator_kinerja_id')->using(Master_12_PetaIkMk::class)->withPivot('id');
    }

    public function tujuanPembelajaran()
    {
        return $this->hasMany(Master_13_TujuanPembelajaran::class, '11_MASTER_mk_register_id');
    }

    public function rencanaAsesmen()
    {
        return $this->hasMany(Master_15_RencanaAsesmen::class, '11_MASTER_mk_register_id');
    }

    public function dosen()
    {
        return $this->belongsToMany(Master_04_Dosen::class, '19_MASTER_pengampu', '11_MASTER_mk_register_id', '04_MASTER_dosen_kode');
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Master_06_Mahasiswa::class, '20_MASTER_mahasiswa_perkuliahan', '11_MASTER_mk_register_id', '06_MASTER_mahasiswa_nim');
    }

    public function referensi()
    {
        return $this->belongsToMany(Master_22_Referensi::class, '25_MASTER_referensi_utama', '23_MASTER_mk_register_id', '22_MASTER_referensi_id');
    }

    public function getMataKuliahByIdMataKuliahRegister($id){
        return $this->where('07_MASTER_mata_kuliah_id', $id)->first();
    }
}
