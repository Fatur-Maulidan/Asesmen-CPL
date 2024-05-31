<?php

namespace App\Models;

use App\Enums\StatusKurikulum;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
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
    protected $fillable = ['tahun', 'tahun_berlaku', 'tahun_berakhir', 'status', 'konf_tenggat_waktu_tp', 'jumlah_maksimal_rubrik', 'nilai_rentang_rubrik', '02_MASTER_program_studi_id'];

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

    // Relationship
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, '02_MASTER_program_studi_id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, '03_MASTER_kurikulum_id');
    }

    public function cpl()
    {
        return $this->hasMany(CapaianPembelajaranLulusan::class, '03_MASTER_kurikulum_id');
    }
}
