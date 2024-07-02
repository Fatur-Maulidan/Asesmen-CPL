<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create17MasterPengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('17_MASTER_pengampu', function (Blueprint $table) {
            $table->foreignId('04_MASTER_dosen_id')->constrained('04_MASTER_dosen');
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
        Schema::dropIfExists('17_MASTER_pengampu');
    }
}
