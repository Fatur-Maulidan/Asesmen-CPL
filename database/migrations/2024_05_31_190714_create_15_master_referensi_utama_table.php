<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create15MasterReferensiUtamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('15_MASTER_referensi_utama', function (Blueprint $table) {
            $table->foreignId('10_MASTER_mk_register_id')->constrained('10_MASTER_mk_register');
            $table->foreignId('11_MASTER_referensi_id')->constrained('11_MASTER_referensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('15_MASTER_referensi_utama');
    }
}
