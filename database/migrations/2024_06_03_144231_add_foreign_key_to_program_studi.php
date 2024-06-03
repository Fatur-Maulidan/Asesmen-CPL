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
            $table->foreign('koordinator_nip')->references('nip')->on('04_MASTER_dosen')->comment('Field untuk menyimpan koordinator program studi.');
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
            $table->dropForeign(['koordinator_nip']);
        });
    }
}
