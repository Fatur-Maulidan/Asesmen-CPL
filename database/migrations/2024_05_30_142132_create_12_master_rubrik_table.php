<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create12MasterRubrikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('12_MASTER_rubrik', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('urutan');
            $table->string('level_kemampuan', 20);
            $table->string('deskripsi', 600);
            $table->timestamps();
            $table->foreignId('08_MASTER_indikator_kinerja_id')->constrained('08_MASTER_indikator_kinerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('12_MASTER_rubrik');
    }
}
