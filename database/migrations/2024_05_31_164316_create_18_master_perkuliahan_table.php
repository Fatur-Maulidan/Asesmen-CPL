<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create18MasterPerkuliahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('18_MASTER_perkuliahan', function (Blueprint $table) {
            $table->string('06_MASTER_mahasiswa_nim', 9);
            $table->foreignId('11_MASTER_mk_register_id')->constrained('11_MASTER_mk_register');

            $table->foreign('06_MASTER_mahasiswa_nim')->references('nim')->on('06_MASTER_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('18_MASTER_perkuliahan');
    }
}
