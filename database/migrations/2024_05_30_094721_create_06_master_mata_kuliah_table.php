<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create06MasterMataKuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('06_MASTER_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->unique();
            $table->string('nama', 60);
            $table->string('deskripsi', 600)->nullable();
            $table->unsignedTinyInteger('jumlah_sks');
            $table->timestamps();
            $table->foreignId('03_MASTER_kurikulum_id')->constrained('03_MASTER_kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('06_MASTER_mata_kuliah');
    }
}
