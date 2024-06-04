<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToDosen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('04_MASTER_dosen', function (Blueprint $table) {
            $table->foreign('02_MASTER_program_studi_id')->references('id')->on('02_MASTER_program_studi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('04_MASTER_dosen', function (Blueprint $table) {
            $table->dropForeign(['02_MASTER_program_studi_id']);
        });
    }
}
