<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create14MasterPetaIkTpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('14_MASTER_peta_ik_tp', function (Blueprint $table) {
            $table->foreignId('12_MASTER_peta_ik_mk_id')->constrained('12_MASTER_peta_ik_mk');
            $table->foreignId('13_MASTER_tujuan_pembelajaran_id')->constrained('13_MASTER_tujuan_pembelajaran');
            $table->unsignedTinyInteger('bobot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('14_MASTER_peta_ik_tp');
    }
}
