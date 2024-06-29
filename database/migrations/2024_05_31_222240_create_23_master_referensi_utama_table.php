<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create23MasterReferensiUtamaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('23_MASTER_referensi_utama', function (Blueprint $table) {
            $table->foreignId('11_MASTER_mk_register_id')->constrained('11_MASTER_mk_register');
            $table->foreignId('20_MASTER_referensi_id')->constrained('20_MASTER_referensi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('23_MASTER_referensi_utama');
    }
}
