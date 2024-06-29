<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create07MasterMataKuliahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('07_MASTER_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 12)->unique();
            $table->string('nama', 50);
            $table->string('deskripsi', 1000);
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
        Schema::dropIfExists('07_MASTER_mata_kuliah');
    }
}
