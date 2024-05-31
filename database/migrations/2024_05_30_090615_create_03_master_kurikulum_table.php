<?php

use App\Enums\StatusKurikulum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create03MasterKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('03_MASTER_kurikulum', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->year('tahun_berlaku');
            $table->year('tahun_berakhir')->nullable();
            $table->enum('status', StatusKurikulum::getValues());
            $table->dateTime('konf_tenggat_waktu_tp')->nullable();
            $table->unsignedTinyInteger('jumlah_maksimal_rubrik')->nullable();
            $table->json('nilai_rentang_rubrik')->nullable();
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
        Schema::dropIfExists('03_MASTER_kurikulum');
    }
}
