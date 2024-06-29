<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create10MasterRubrikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('10_MASTER_rubrik', function (Blueprint $table) {
            $table->unsignedTinyInteger('urutan');
            $table->string('deskripsi', 100);
            $table->timestamps();
            $table->foreignId('09_MASTER_indikator_kinerja_id')->constrained('09_MASTER_indikator_kinerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('10_MASTER_rubrik');
    }
}
