<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCapaianPembelajaranLulusan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('capaian_pembelajaran_lulusan', function (Blueprint $table) {
            $table->renameColumn('created_at', 'tanggal_pengajuan');
            $table->renameColumn('updated_at', 'tanggal_pembaruan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('capaian_pembelajaran_lulusan', function (Blueprint $table) {
            $table->renameColumn('tanggal_pengajuan', 'created_at');
            $table->renameColumn('tanggal_pembaruan', 'updated_at');
        });
    }
}
