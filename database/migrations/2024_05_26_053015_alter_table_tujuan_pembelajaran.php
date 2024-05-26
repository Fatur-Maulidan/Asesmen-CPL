<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTujuanPembelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->integer('bobot')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->integer('bobot')->change();
        });
    }
}
