<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaranLulusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'domain',
        'deskripsi',
        'tanggal_pengajuan',
        'tanggal_pembaruan'
    ];

    protected $table = 'capaian_pembelajaran_lulusan';

    public $timestamps = false;
}
