<?php

use App\Enums\DomainCPL;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create08MasterCapaianPembelajaranLulusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('08_MASTER_capaian_pembelajaran_lulusan', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);
            $table->enum('domain', DomainCPL::getValues());
            $table->string('deskripsi', 1000);
            $table->timestamps();
            $table->foreignId('03_MASTER_kurikulum_id')->constrained('03_MASTER_kurikulum')->index('08_master_cpl_03_master_kurikulum_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('08_MASTER_capaian_pembelajaran_lulusan');
    }
}
