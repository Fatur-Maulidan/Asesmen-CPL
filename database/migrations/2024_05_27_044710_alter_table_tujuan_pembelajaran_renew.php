<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableTujuanPembelajaranRenew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->renameColumn('kodeTP', 'kode');
            $table->renameColumn('status', 'status_validasi');
            $table->dropColumn('bobot');
            $table->renameColumn('created_at', 'tanggal_pengajuan');
            $table->renameColumn('updated_at', 'tanggal_pembaruan');
            $table->timestamp('tanggal_validasi')->nullable()->after('updated_at');
            $table->text('alasan_penolakan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('tujuan_pembelajaran', function (Blueprint $table) {
            $table->renameColumn('kode', 'kodeTP');
            $table->renameColumn('status_validasi', 'status');
            $table->renameColumn('created_at', 'tanggal_pengajuan');
            $table->renameColumn('updated_at', 'tanggal_pembaruan');
            $table->timestamp('tanggal_validasi')->nullable()->after('tanggal_pembaruan');
            $table->text('alasan_penolakan')->nullable()->after('tanggal_validasi');
        });
    }
}
