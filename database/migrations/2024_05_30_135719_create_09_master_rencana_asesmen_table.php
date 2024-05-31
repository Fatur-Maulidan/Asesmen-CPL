<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create09MasterRencanaAsesmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('09_MASTER_rencana_asesmen', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 15);
            $table->string('kode', 20);
            $table->unsignedInteger('minggu');
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
        Schema::dropIfExists('09_MASTER_rencana_asesmen');
    }
}
