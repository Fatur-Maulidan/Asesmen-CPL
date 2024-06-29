<?php

use App\Enums\JenisKelamin;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create06MasterMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('06_MASTER_mahasiswa', function (Blueprint $table) {
            $table->string('nim', 9)->primary();
            $table->string('nama', 50);
            $table->enum('jenis_kelamin', JenisKelamin::getValues());
            $table->string('email', 50)->unique();
            $table->string('kelas', 2);
            $table->year('tahun_angkatan');
            $table->enum('status', StatusKeaktifan::getValues())->default(StatusKeaktifan::Aktif);
            $table->timestamps();
            $table->foreignId('02_MASTER_program_studi_id')->constrained('02_MASTER_program_studi');
            $table->foreignId('03_MASTER_kurikulum_id')->constrained('03_MASTER_kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('06_MASTER_mahasiswa');
    }
}
