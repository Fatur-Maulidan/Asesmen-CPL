<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'deskripsi',
        'status_validasi',
        'tanggal_pengajuan',
        'tanggal_pembaruan',
        'tanggal_validasi',
        'alasan_penolakan'
    ];

    protected $table = 'tujuan_pembelajaran';

    public $timestamps = false;
}
