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
            $table->string('nama',50);
            $table->string('kode',6);
            $table->enum('jenjang_pendidikan', JenjangPendidikan::getValues());
            $table->timestamps();
            $table->foreignId('01_MASTER_jurusan_id')->constrained('01_MASTER_jurusan');
            $table->string('04_MASTER_dosen_kode',6)->nullable();
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
