<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create11MasterReferensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('11_MASTER_referensi', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 50);
            $table->string('penerbit', 30);
            $table->year('tahun_terbit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('11_MASTER_referensi');
    }
}
