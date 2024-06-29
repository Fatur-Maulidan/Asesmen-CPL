<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToProgramStudi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('02_MASTER_program_studi', function (Blueprint $table) {
            $table->foreign('04_MASTER_dosen_kode')->references('kode')->on('04_MASTER_dosen')->comment('Field untuk menyimpan koordinator program studi.');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('02_MASTER_program_studi', function (Blueprint $table) {
            $table->dropForeign(['04_MASTER_dosen_kode']);
        });
    }
}
