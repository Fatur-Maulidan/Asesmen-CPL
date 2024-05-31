<?php

use App\Enums\JenisKelamin;
use App\Enums\RoleDosen;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create04MasterDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('04_MASTER_dosen', function (Blueprint $table) {
            $table->string('nip', 18)->primary();
            $table->string('kode', 6)->unique();
            $table->string('nama', 50);
            $table->string('email', 50)->unique();
            $table->enum('jenis_kelamin', JenisKelamin::getValues());
            $table->enum('role', RoleDosen::getValues());
            $table->enum('status', StatusKeaktifan::getValues());
            $table->timestamps();
            $table->foreignId('01_MASTER_jurusan_id')->constrained('01_MASTER_jurusan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('04_MASTER_dosen');
    }
}
