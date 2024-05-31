<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create17MasterPetaIkMkTpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('17_MASTER_peta_ik_mk_tp', function (Blueprint $table) {
            $table->foreignId('10_MASTER_mk_register_id')->constrained('10_MASTER_mk_register');
            $table->foreignId('13_MASTER_peta_cp_ik_id')->constrained('13_MASTER_peta_cp_ik');
            $table->foreignId('16_MASTER_tujuan_pembelajaran_id')->constrained('16_MASTER_tujuan_pembelajaran');
            $table->unsignedInteger('bobot_tp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('17_MASTER_peta_ik_mk_tp');
    }
}
