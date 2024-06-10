<?php

namespace App\Models;

use App\Enums\StatusKurikulum;
use Illuminate\Database\Eloquent\Model;

class Master_03_Kurikulum extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '03_MASTER_kurikulum';

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
    protected $fillable = ['tahun', 'tahun_berlaku', 'tahun_berakhir', 'status', '02_MASTER_program_studi_nomor'];

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
        'status' => StatusKurikulum::class
    ];

    // # Relations
    public function programStudi()
    {
        return $this->belongsTo(Master_02_ProgramStudi::class, '02_MASTER_program_studi_nomor');
    }

    public function mataKuliah()
    {
        return $this->hasMany(Master_07_MataKuliah::class, '03_MASTER_kurikulum_id');
    }

    public function capaianPembelajaranLulusan()
    {
        return $this->hasMany(Master_08_CapaianPembelajaranLulusan::class, '03_MASTER_kurikulum_id');
    }

    public function indikatorKinerja()
    {
        return $this->hasMany(Master_09_IndikatorKinerja::class, '03_MASTER_kurikulum_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Master_06_Mahasiswa::class, '03_MASTER_kurikulum_id');
    }

    // # Scope
    public function scopeAktif($query)
    {
        return $query->where('status', StatusKurikulum::Aktif);
    }

    public function scopeNonaktif($query)
    {
        return $query->where('status', StatusKurikulum::Nonaktif);
    }

    public function scopePeninjauan($query)
    {
        return $query->where('status', StatusKurikulum::Peninjauan());
    }

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('tahun', 'like', '%' . request('search') . '%');
        }
    }

    // # Methods
    /**
     * Mendapatkan ID Program Studi berdasarkan tahun kurikulumnya
     *
     * @param  string  $tahunAkademikVal
     * @return int
     */
    public function getProgramStudiId($tahunAkademikVal)
    {
        return $this->where('tahun', $tahunAkademikVal)->pluck('02_MASTER_program_studi_id')[0];
    }

    public function getKurikulumByNomorProdi($nomorProdi, $kurikulum){
        return $this->where('02_MASTER_program_studi_nomor', $nomorProdi)
                    ->where('tahun', $kurikulum)
                    ->with('capaianPembelajaranLulusan')
                    ->first();
    }
}
