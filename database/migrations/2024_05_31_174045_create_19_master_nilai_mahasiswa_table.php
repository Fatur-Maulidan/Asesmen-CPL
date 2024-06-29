<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create19MasterNilaiMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('19_MASTER_nilai_mahasiswa', function (Blueprint $table) {
            $table->string('06_MASTER_mahasiswa_nim', 9);
            $table->foreignId('15_MASTER_rencana_asesmen_id')->constrained('15_MASTER_rencana_asesmen');
            $table->unsignedTinyInteger('nilai')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('19_MASTER_nilai_mahasiswa');
    }
}
