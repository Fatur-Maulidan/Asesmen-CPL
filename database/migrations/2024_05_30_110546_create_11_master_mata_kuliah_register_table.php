<?php

use App\Enums\JenisPerkuliahan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create11MasterMataKuliahRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('11_MASTER_mk_register', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_akademik_awal');
            $table->year('tahun_akademik_akhir');
            $table->unsignedTinyInteger('semester');
            $table->enum('jenis', JenisPerkuliahan::getValues());
            $table->timestamps();
            $table->foreignId('07_MASTER_mata_kuliah_id')->constrained('07_MASTER_mata_kuliah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('11_MASTER_mk_register');
    }
}
