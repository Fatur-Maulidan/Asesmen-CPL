<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create16MasterTujuanPembelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('16_MASTER_tujuan_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('deskripsi', 600);
            $table->dateTime('tanggal_diajukan')->nullable();
            $table->dateTime('tanggal_divalidasi')->nullable();
            $table->string('alasan_penolakan', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('16_MASTER_tujuan_pembelajaran');
    }
}
