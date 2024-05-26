<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeTP',
        'deskripsi',
        'bobot',
    ];

    protected $table = 'tujuan_pembelajaran';
}
