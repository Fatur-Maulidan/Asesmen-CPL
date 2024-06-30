<?php

use App\Enums\KategoriJurusan;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create01MasterJurusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('01_MASTER_jurusan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->enum('kategori', KategoriJurusan::getValues());
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
        Schema::dropIfExists('01_MASTER_jurusan');
    }
}
