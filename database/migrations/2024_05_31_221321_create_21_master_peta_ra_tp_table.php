<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create21MasterPetaRaTpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('21_MASTER_peta_ra_tp', function (Blueprint $table) {
            $table->foreignId('09_MASTER_rencana_asesmen_id')->constrained('09_MASTER_rencana_asesmen');
            $table->foreignId('16_MASTER_tujuan_pembelajaran_id')->constrained('16_MASTER_tujuan_pembelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('21_MASTER_peta_ra_tp');
    }
}
