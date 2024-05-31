<?php

use App\Enums\JenisKelamin;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create05MasterMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('05_MASTER_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 9)->primary();
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', JenisKelamin::getValues());
            $table->string('email', 50)->unique();
            $table->string('kelas', 2);
            $table->year('tahun_angkatan');
            $table->enum('status', StatusKeaktifan::getValues());
            $table->timestamps();
            $table->foreignId('02_MASTER_program_studi_id')->constrained('02_MASTER_program_studi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('05_MASTER_mahasiswa');
    }
}
