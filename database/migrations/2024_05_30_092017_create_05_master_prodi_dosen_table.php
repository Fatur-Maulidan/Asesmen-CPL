<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create05MasterProdiDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('05_MASTER_prodi_dosen', function (Blueprint $table) {
            $table->foreignId('02_MASTER_program_studi_id')->constrained('02_MASTER_program_studi');
            $table->string('04_MASTER_dosen_kode',6);
            $table->foreign('04_MASTER_dosen_kode')->references('kode')->on('04_MASTER_dosen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('05_MASTER_prodi_dosen');
    }
}
