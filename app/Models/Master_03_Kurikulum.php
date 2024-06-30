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
    protected $fillable = ['tahun', 'tahun_berlaku', 'tahun_berakhir', 'status', 'konf_tenggat_waktu_tp', '02_MASTER_program_studi_id'];

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
        'status' => StatusKurikulum::class,
        'konf_tenggat_waktu_tp' => 'datetime',
    ];

    // # Relations
    public function programStudi()
    {
        return $this->belongsTo(Master_02_ProgramStudi::class, '02_MASTER_program_studi_id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(Master_07_MataKuliah::class, '03_MASTER_kurikulum_id');
    }

    public function capaianPembelajaranLulusan()
    {
        return $this->hasMany(Master_08_CapaianPembelajaranLulusan::class, '03_MASTER_kurikulum_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Master_06_Mahasiswa::class, '03_MASTER_kurikulum_id');
    }

    // # Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', StatusKurikulum::Aktif);
    }

    public function scopeArsip($query)
    {
        return $query->where('status', StatusKurikulum::Arsip);
    }

    public function scopePengelolaan($query)
    {
        return $query->where('status', StatusKurikulum::Pengelolaan);
    }

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('tahun', 'like', '%' . request('search') . '%');
        }
    }

    public function scopeProdi($query, $program_studi_id)
    {
        return $query->where('program_studi_id', $program_studi_id);
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

    public function getKurikulumByNomorProdi($idProdi, $kurikulum){
        return $this->where('02_MASTER_program_studi_id', $idProdi)
                    ->where('tahun', $kurikulum)
                    ->with('capaianPembelajaranLulusan.indikatorKinerja.mataKuliahRegister.mataKuliah')
                    ->first();
    }

    // # Accessor
    // Retrieve distinct angkatan_mahasiswa_terdaftar values
    public function getAngkatanMahasiswaTerdaftarAttribute()
    {
        return $this->mahasiswa->pluck('tahun_angkatan')->unique()->sort()->values()->all();
    }

    public function getDataIfKurikulumProgramStudiIsExist($kaprodiNip, $kurikulum){
        $kaprodi = new Master_04_Dosen();
        $kaprodi = $kaprodi->getProdiKodeByDosenNip($kaprodiNip);
        return $this->getKurikulumByNomorProdi($kaprodi->programStudi->first()->nomor, $kurikulum);
    }

    public function getKurikulumByYearAndProdi($tahun, $program_studi_nomor)
    {
        return $this->where('tahun', $tahun)->where('02_MASTER_program_studi_nomor', $program_studi_nomor)->first();
    }
}
