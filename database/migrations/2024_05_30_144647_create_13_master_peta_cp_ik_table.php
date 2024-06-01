<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create13MasterPetaCpIkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('13_MASTER_peta_cp_ik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('07_MASTER_capaian_pembelajaran_lulusan_id')->constrained('07_MASTER_capaian_pembelajaran_lulusan')->index('13_master_peta_cp_ik_07_master_cpl_id_foreign');
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
        Schema::dropIfExists('13_MASTER_peta_cp_ik');
    }
}
