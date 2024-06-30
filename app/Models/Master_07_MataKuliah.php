<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Master_07_MataKuliah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '07_MASTER_mata_kuliah';

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
    protected $fillable = ['kode', 'nama', 'deskripsi', '03_MASTER_kurikulum_id'];

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

    public function mataKuliahRegister()
    {
        return $this->hasMany(Master_11_MataKuliahRegister::class, '07_MASTER_mata_kuliah_id');
    }

    public function ketercapaian()
    {
        return $this->hasMany(Analisis_01_Ketercapaian_Mahasiswa::class, 'id_mata_kuliah');
    }


    // # Methods
    // Method ini digunakan untuk mendapatkan informasi yang terdapat pada Mata Kuliah Register
    public function getMataKuliahByDosen($mataKuliahRegister) {
        $dataMataKuliah = [];
        foreach ($mataKuliahRegister as $mataKuliah) {
            $dataMataKuliah[] = $this->where('id',$mataKuliah->{'06_MASTER_mata_kuliah_id'})->with('mataKuliahRegister')->first();
        }
        return $dataMataKuliah;
    }

    public function getMataKuliahByKurikulum($kurikulum) {
        return $this->where('03_MASTER_kurikulum_id', $kurikulum)->get();
    }

    public function getMataKuliahByNamaAndKurikulum($nama, $kurikulum) {
        return $this->where('03_MASTER_kurikulum_id', $kurikulum)->where('nama',$nama)->first();
    }

    public function getMataKuliahByKodeAndKurikulum($kode, $kurikulum) {
        return $this->where('03_MASTER_kurikulum_id', $kurikulum)->where('kode',$kode)->first();
    }
}
