<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create12MasterPetaIkMkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('12_MASTER_peta_ik_mk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('09_MASTER_indikator_kinerja_id')->constrained('09_MASTER_indikator_kinerja');
            $table->foreignId('11_MASTER_mk_register_id')->constrained('11_MASTER_mk_register');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('12_MASTER_peta_ik_mk');
    }
}
