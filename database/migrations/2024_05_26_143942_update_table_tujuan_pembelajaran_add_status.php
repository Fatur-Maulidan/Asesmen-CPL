<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableTujuanPembelajaranAddStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->enum('status', ['Disetujui', 'Menunggu Validasi', 'Ditolak'])->default('Menunggu Validasi')->after('bobot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->enum('status', ['Disetujui', 'Menunggu Validasi', 'Ditolak'])->default('Menunggu Validasi')->after('bobot');
        });
    }
}
