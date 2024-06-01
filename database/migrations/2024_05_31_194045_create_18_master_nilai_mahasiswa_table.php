<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create18MasterNilaiMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('18_MASTER_nilai_mahasiswa', function (Blueprint $table) {
            $table->string('05_MASTER_mahasiswa_nim', 9);
            $table->foreignId('09_MASTER_rencana_asesmen_id')->constrained('09_MASTER_rencana_asesmen');
            $table->unsignedInteger('nilai_ra')->nullable();
            $table->timestamps();
            $table->foreign('05_MASTER_mahasiswa_nim')->references('nim')->on('05_MASTER_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('18_MASTER_nilai_mahasiswa');
    }
}
