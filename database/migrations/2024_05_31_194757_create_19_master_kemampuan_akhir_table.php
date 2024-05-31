<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create19MasterKemampuanAkhirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('19_MASTER_kemampuan_akhir', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi', 600);
            $table->string('materi', 200);
            $table->unsignedTinyInteger('minggu');
            $table->string('kriteria', 200);
            $table->foreignId('16_MASTER_tujuan_pembelajaran_id')->constrained('16_MASTER_tujuan_pembelajaran')->index('19_master_kemampuan_akhir_16_master_tp_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('19_MASTER_kemampuan_akhir');
    }
}
