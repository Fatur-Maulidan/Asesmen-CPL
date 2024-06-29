<?php

use App\Enums\JenisPerkuliahan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create01AnalisisKetercapaianMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('01_ANALISIS_ketercapaian_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 9);
            $table->foreignId('id_mata_kuliah');
            $table->foreignId('id_mk_register');
            $table->foreignId('id_cpl');
            $table->foreignId('id_ik');
            $table->foreignId('id_ra');
            $table->foreignId('id_tp');
            $table->string('kode_mata_kuliah', 12);
            $table->string('nama_mata_kuliah', 50);
            $table->year('tahun_akademik_awal');
            $table->year('tahun_akademik_akhir');
            $table->unsignedTinyInteger('semester');
            $table->enum('jenis', JenisPerkuliahan::getValues());
            $table->string('kode_cpl', 10);
            $table->string('kode_ik', 10);
            $table->string('kode_ra', 10);
            $table->string('kode_tp', 10);
            $table->decimal('ketercapaian_tp', 4, 2);

            $table->foreign('nim')->references('nim')->on('06_MASTER_mahasiswa');
            $table->foreign('id_mata_kuliah')->references('id')->on('07_MASTER_mata_kuliah');
            $table->foreign('id_mk_register')->references('id')->on('11_MASTER_mk_register');
            $table->foreign('id_cpl')->references('id')->on('08_MASTER_capaian_pembelajaran_lulusan');
            $table->foreign('id_ik')->references('id')->on('09_MASTER_indikator_kinerja');
            $table->foreign('id_ra')->references('id')->on('15_MASTER_rencana_asesmen');
            $table->foreign('id_tp')->references('id')->on('13_MASTER_tujuan_pembelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('01_ANALISIS_ketercapaian_mahasiswa');
    }
}
