<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create22MasterReferensiRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('22_MASTER_referensi_register', function (Blueprint $table) {
            $table->foreignId('20_MASTER_referensi_id')->constrained('20_MASTER_referensi');
            $table->foreignId('21_MASTER_pengarang_id')->constrained('21_MASTER_pengarang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('22_MASTER_referensi_utama');
    }
}
