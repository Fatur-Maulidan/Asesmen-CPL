<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create08MasterIndikatorKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('08_MASTER_indikator_kinerja', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('deskripsi', 600);
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
        Schema::dropIfExists('08_MASTER_indikator_kinerja');
    }
}
