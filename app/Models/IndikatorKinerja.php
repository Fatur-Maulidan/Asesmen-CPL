<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorKinerja extends Model
{
    use HasFactory;

    protected $table = 'indikator_kinerja';

    protected $fillable = [
        'kode',
        'indikator',
        'deskripsi',
        'bobot',
    ];

    public $timestamps = false;
}
