<?php

use App\Enums\JenisPerkuliahan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create14MasterPerkuliahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('14_MASTER_perkuliahan', function (Blueprint $table) {
            $table->string('04_MASTER_dosen_nip', 18);
            $table->string('05_MASTER_mahasiswa_nim', 9);
            $table->foreignId('10_MASTER_mk_register_id')->constrained('10_MASTER_mk_register');
            $table->string('kelas_ajar', 2);
            $table->enum('jenis', JenisPerkuliahan::getValues());
            $table->foreign('04_MASTER_dosen_nip')->references('nip')->on('04_MASTER_dosen');
            $table->foreign('05_MASTER_mahasiswa_nim')->references('nim')->on('05_MASTER_mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('14_MASTER_perkuliahan');
    }
}
