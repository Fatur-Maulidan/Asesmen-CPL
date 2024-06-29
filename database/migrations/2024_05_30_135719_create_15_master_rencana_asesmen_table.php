<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create15MasterRencanaAsesmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('15_MASTER_rencana_asesmen', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20);
            $table->string('kategori', 15);
            $table->unsignedTinyInteger('minggu');
            $table->timestamps();
            $table->foreignId('11_MASTER_mk_register_id')->constrained('11_MASTER_mk_register');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('15_MASTER_rencana_asesmen');
    }
}
