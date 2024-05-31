<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create20MasterSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('20_MASTER_soal', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nomor');
            $table->string('deskripsi', 45);
            $table->foreignId('19_MASTER_kemampuan_akhir_id')->constrained('19_MASTER_kemampuan_akhir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('20_MASTER_soal');
    }
}
