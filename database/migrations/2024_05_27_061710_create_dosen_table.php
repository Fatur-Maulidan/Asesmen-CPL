<?php

use App\Enums\JenisKelamin;
use App\Enums\PeranDosen;
use App\Enums\StatusKeaktifan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->char('nip', 18);
            $table->string('kode', 10);
            $table->string('nama', 50);
            $table->boolean('jenis_kelamin');
            $table->string('email', 50);
            $table->string('kata_sandi');
            $table->boolean('status');
            $table->enum('peran', PeranDosen::getValues());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen');
    }
}
