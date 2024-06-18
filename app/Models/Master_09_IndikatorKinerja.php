<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_09_IndikatorKinerja extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '09_MASTER_indikator_kinerja';

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
    protected $fillable = ['kode', 'deskripsi', '03_MASTER_kurikulum_id', '08_MASTER_capaian_pembelajaran_lulusan_id'];

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
    protected $casts = [];

    // # Relations
    public function kurikulum()
    {
        return $this->belongsTo(Master_03_Kurikulum::class, '03_MASTER_kurikulum_id');
    }

    public function capaianPembelajaranLulusan()
    {
        return $this->belongsTo(Master_08_CapaianPembelajaranLulusan::class, '08_MASTER_capaian_pembelajaran_lulusan_id');
    }

    public function rubrik()
    {
        return $this->hasMany(Master_10_Rubrik::class, '09_MASTER_indikator_kinerja_id');
    }

    public function mataKuliahRegister()
    {
        return $this->belongsToMany(Master_11_MataKuliahRegister::class, '12_MASTER_peta_ik_mk', '09_MASTER_indikator_kinerja_id', '11_MASTER_mk_register_id')->using(Master_12_PetaIkMk::class);
    }

    // # Methods
    // Fungsi ini digunakan untuk mendapatkan data
        // Indikator Kinerja -> CPL berdasarkan kurikulum yang berjalan
        // Indikator Kinerja -> Master10Rubrik
    public function getDataIndikatorKinerja($kurikulum, $idCpl = '', $kode = '', $mataKuliah = true) {
        $indikatorKinerja = $this->with('capaianPembelajaranLulusan');
        $indikatorKinerja = empty($kode) ? $indikatorKinerja : $indikatorKinerja->where('kode', $kode)->with('rubrik');
        $indikatorKinerja = empty($idCpl) ? $indikatorKinerja : $indikatorKinerja->where('08_MASTER_capaian_pembelajaran_lulusan_id', $idCpl);
        $indikatorKinerja = empty($mataKuliah) ? $indikatorKinerja : $indikatorKinerja->with('mataKuliahRegister')->whereHas('mataKuliahRegister', function($query) use ($kurikulum) {
            $query->where('03_MASTER_kurikulum_id', $kurikulum);
        });
        $indikatorKinerja = $indikatorKinerja->where('03_MASTER_kurikulum_id',$kurikulum)->with('capaianPembelajaranLulusan')->get();

        return $indikatorKinerja;
    }
}
