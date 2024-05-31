<?php

use App\Enums\StatusMataKuliah;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create10MasterMataKuliahRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('10_MASTER_mk_register', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_akademik', 9);
            $table->unsignedTinyInteger('semester');
            $table->enum('status', StatusMataKuliah::getValues());
            $table->timestamps();
            $table->foreignId('06_MASTER_mata_kuliah_id')->constrained('06_MASTER_mata_kuliah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('10_MASTER_mk_register');
    }
}
