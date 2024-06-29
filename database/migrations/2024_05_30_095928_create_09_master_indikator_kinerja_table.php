<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create09MasterIndikatorKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('09_MASTER_indikator_kinerja', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('deskripsi', 1000);
            $table->timestamps();
            $table->foreignId('08_MASTER_capaian_pembelajaran_lulusan_id')->constrained('08_MASTER_capaian_pembelajaran_lulusan')
                ->index('09_master_ik_08_master_cpl_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('09_MASTER_indikator_kinerja');
    }
}
