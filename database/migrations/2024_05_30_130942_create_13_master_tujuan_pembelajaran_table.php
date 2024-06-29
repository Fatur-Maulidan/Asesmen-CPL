<?php

use App\Enums\StatusValidasiTP;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create13MasterTujuanPembelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('13_MASTER_tujuan_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->string('deskripsi', 1000);
            $table->dateTime('tanggal_divalidasi')->nullable();
            $table->enum('status', StatusValidasiTP::getValues())->default(StatusValidasiTP::Proses);
            $table->string('alasan_penolakan', 1000)->nullable();
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
        Schema::dropIfExists('13_MASTER_tujuan_pembelajaran');
    }
}
