<?php

use App\Enums\JenjangPendidikan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create02MasterProgramStudiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('02_MASTER_program_studi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 4);
            $table->string('nama', 50)->unique();
            $table->string('kode', '10')->unique();
            $table->enum('jenjang_pendidikan', JenjangPendidikan::getValues());
            $table->timestamps();
            $table->foreignId('01_MASTER_jurusan_id')->constrained('01_MASTER_jurusan');
            $table->string('koordinator_nip', 18)->nullable();
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
        Schema::dropIfExists('02_MASTER_program_studi');
    }
}
