<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = '06_MASTER_mata_kuliah';

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
    protected $fillable = ['kode', 'nama', 'deskripsi', 'jumlah_sks', '03_MASTER_kurikulum_id'];

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

    // Relationship
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, '03_MASTER_kurikulum_id');
    }
}
