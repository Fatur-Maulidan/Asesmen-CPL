<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create23MasterPengarangReferensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('23_MASTER_pengarang_referensi', function (Blueprint $table) {
            $table->foreignId('11_MASTER_referensi_id')->constrained('11_MASTER_referensi');
            $table->foreignId('23_MASTER_pengarang_id')->constrained('22_MASTER_pengarang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('23_MASTER_pengarang_referensi');
    }
}
