<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `peta_ik_tp_agg` AS
            select
                `mr`.`id` AS `id_mk_register`,
                `mk`.`id` AS `id_mata_kuliah`,
                `cpl`.`id` AS `id_cpl`,
                `ik`.`id` AS `id_ik`,
                `tp`.`id` AS `id_tp`,
                `mk`.`kode` AS `kode_mata_kuliah`,
                `mk`.`nama` AS `nama_mata_kuliah`,
                `mr`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `mr`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `mr`.`semester` AS `semester`,
                `mr`.`jenis` AS `jenis`,
                `cpl`.`kode` AS `kode_cpl`,
                `ik`.`kode` AS `kode_ik`,
                `tp`.`kode` AS `kode_tp`,
                `pit`.`bobot_tp` AS `bobot_tp`
            from
                ((((((`11_MASTER_mk_register` `mr`
            join `07_MASTER_mata_kuliah` `mk` on
                ((`mr`.`07_MASTER_mata_kuliah_id` = `mk`.`id`)))
            join `13_MASTER_tujuan_pembelajaran` `tp` on
                ((`tp`.`11_MASTER_mk_register_id` = `mr`.`id`)))
            join `14_MASTER_peta_ik_tp` `pit` on
                ((`pit`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)))
            join `12_MASTER_peta_ik_mk` `pim` on
                ((`pit`.`12_MASTER_peta_ik_mk_id` = `pim`.`id`)))
            join `09_MASTER_indikator_kinerja` `ik` on
                ((`pim`.`09_MASTER_indikator_kinerja_id` = `ik`.`id`)))
            join `08_MASTER_capaian_pembelajaran_lulusan` `cpl` on
                ((`ik`.`08_MASTER_capaian_pembelajaran_lulusan_id` = `cpl`.`id`)));
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `peta_ik_tp_ra_agg` AS
            select
                `mr`.`id` AS `id_mk_register`,
                `mk`.`id` AS `id_mata_kuliah`,
                `cpl`.`id` AS `id_cpl`,
                `ik`.`id` AS `id_ik`,
                `tp`.`id` AS `id_tp`,
                `ra`.`id` AS `id_ra`,
                `mk`.`kode` AS `kode_mata_kuliah`,
                `mk`.`nama` AS `nama_mata_kuliah`,
                `mr`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `mr`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `mr`.`semester` AS `semester`,
                `mr`.`jenis` AS `jenis`,
                `ra`.`kode` AS `kode_ra`,
                `cpl`.`kode` AS `kode_cpl`,
                `ik`.`kode` AS `kode_ik`,
                `tp`.`kode` AS `kode_tp`,
                `pit`.`bobot_tp` AS `bobot_tp`
            from
                ((((((((`11_MASTER_mk_register` `mr`
            join `07_MASTER_mata_kuliah` `mk` on
                ((`mr`.`07_MASTER_mata_kuliah_id` = `mk`.`id`)))
            join `15_MASTER_rencana_asesmen` `ra` on
                ((`ra`.`11_MASTER_mk_register_id` = `mr`.`id`)))
            join `16_MASTER_peta_ra_tp` `pat` on
                ((`pat`.`15_MASTER_rencana_asesmen_id` = `ra`.`id`)))
            join `13_MASTER_tujuan_pembelajaran` `tp` on
                ((`pat`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)))
            join `14_MASTER_peta_ik_tp` `pit` on
                ((`pit`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)))
            join `12_MASTER_peta_ik_mk` `pim` on
                ((`pit`.`12_MASTER_peta_ik_mk_id` = `pim`.`id`)))
            join `09_MASTER_indikator_kinerja` `ik` on
                ((`pim`.`09_MASTER_indikator_kinerja_id` = `ik`.`id`)))
            join `08_MASTER_capaian_pembelajaran_lulusan` `cpl` on
                ((`ik`.`08_MASTER_capaian_pembelajaran_lulusan_id` = `cpl`.`id`)));
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `pemetaan_tp_agg_on_ra` AS
            select
                `peta_ik_tp_ra_agg`.`id_mk_register` AS `id_mk_register`,
                `peta_ik_tp_ra_agg`.`id_mata_kuliah` AS `id_mata_kuliah`,
                `peta_ik_tp_ra_agg`.`id_cpl` AS `id_cpl`,
                `peta_ik_tp_ra_agg`.`id_ik` AS `id_ik`,
                `peta_ik_tp_ra_agg`.`id_tp` AS `id_tp`,
                `peta_ik_tp_ra_agg`.`kode_mata_kuliah` AS `kode_mata_kuliah`,
                `peta_ik_tp_ra_agg`.`nama_mata_kuliah` AS `nama_mata_kuliah`,
                `peta_ik_tp_ra_agg`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `peta_ik_tp_ra_agg`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `peta_ik_tp_ra_agg`.`semester` AS `semester`,
                `peta_ik_tp_ra_agg`.`jenis` AS `jenis`,
                `peta_ik_tp_ra_agg`.`kode_cpl` AS `kode_cpl`,
                `peta_ik_tp_ra_agg`.`kode_ik` AS `kode_ik`,
                `peta_ik_tp_ra_agg`.`kode_tp` AS `kode_tp`,
                count(`peta_ik_tp_ra_agg`.`kode_ra`) AS `jumlah_pemetaan_ra`
            from
                `peta_ik_tp_ra_agg`
            group by
                `peta_ik_tp_ra_agg`.`id_mk_register`,
                `peta_ik_tp_ra_agg`.`id_mata_kuliah`,
                `peta_ik_tp_ra_agg`.`id_cpl`,
                `peta_ik_tp_ra_agg`.`id_ik`,
                `peta_ik_tp_ra_agg`.`id_tp`,
                `peta_ik_tp_ra_agg`.`nama_mata_kuliah`,
                `peta_ik_tp_ra_agg`.`tahun_akademik_awal`,
                `peta_ik_tp_ra_agg`.`semester`,
                `peta_ik_tp_ra_agg`.`jenis`,
                `peta_ik_tp_ra_agg`.`kode_cpl`,
                `peta_ik_tp_ra_agg`.`kode_ik`,
                `peta_ik_tp_ra_agg`.`kode_tp`;
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `bobot_tp_agg_on_mk` AS
            select
                `peta_ik_tp_agg`.`id_mk_register` AS `id_mk_register`,
                `peta_ik_tp_agg`.`id_mata_kuliah` AS `id_mata_kuliah`,
                `peta_ik_tp_agg`.`kode_mata_kuliah` AS `kode_mata_kuliah`,
                `peta_ik_tp_agg`.`nama_mata_kuliah` AS `nama_mata_kuliah`,
                `peta_ik_tp_agg`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `peta_ik_tp_agg`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `peta_ik_tp_agg`.`semester` AS `semester`,
                `peta_ik_tp_agg`.`jenis` AS `jenis`,
                sum(`peta_ik_tp_agg`.`bobot_tp`) AS `total_bobot_tp`
            from
                `peta_ik_tp_agg`
            group by
                `peta_ik_tp_agg`.`id_mk_register`,
                `peta_ik_tp_agg`.`id_mata_kuliah`,
                `peta_ik_tp_agg`.`kode_mata_kuliah`,
                `peta_ik_tp_agg`.`nama_mata_kuliah`,
                `peta_ik_tp_agg`.`tahun_akademik_awal`,
                `peta_ik_tp_agg`.`semester`,
                `peta_ik_tp_agg`.`jenis`;
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `jejaring_mata_kuliah` AS
            select
                `p`.`id` AS `id_prodi`,
                `p`.`nama` AS `nama_prodi`,
                `k`.`tahun` AS `tahun_kurikulum`,
                `mk`.`kode` AS `kode_mk`,
                `mk`.`nama` AS `nama_mk`,
                `mr`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `mr`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `mr`.`semester` AS `semester`,
                `mr`.`jenis` AS `jenis`
            from
                (((`11_MASTER_mk_register` `mr`
            join `07_MASTER_mata_kuliah` `mk` on
                ((`mr`.`07_MASTER_mata_kuliah_id` = `mk`.`id`)))
            join `03_MASTER_kurikulum` `k` on
                ((`mk`.`03_MASTER_kurikulum_id` = `k`.`id`)))
            join `02_MASTER_program_studi` `p` on
                ((`k`.`02_MASTER_program_studi_id` = `p`.`id`)));
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `jejaring_rencana_asesmen` AS
            select
                `mk`.`id` AS `id_mk`,
                `mr`.`id` AS `id_mr`,
                `tp`.`id` AS `id_tp`,
                `ra`.`id` AS `id_ra`,
                `mk`.`kode` AS `kode_mk`,
                `mk`.`nama` AS `nama_mk`,
                `mr`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `mr`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `mr`.`semester` AS `semester`,
                `mr`.`jenis` AS `jenis`,
                `ra`.`kode` AS `kode_ra`,
                `tp`.`kode` AS `kode_tp`
            from
                ((((`11_MASTER_mk_register` `mr`
            join `15_MASTER_rencana_asesmen` `ra` on
                ((`ra`.`11_MASTER_mk_register_id` = `mr`.`id`)))
            join `07_MASTER_mata_kuliah` `mk` on
                ((`mr`.`07_MASTER_mata_kuliah_id` = `mk`.`id`)))
            join `16_MASTER_peta_ra_tp` `pat` on
                ((`pat`.`15_MASTER_rencana_asesmen_id` = `ra`.`id`)))
            join `13_MASTER_tujuan_pembelajaran` `tp` on
                ((`pat`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)));
        ');

        DB::unprepared('
            CREATE OR REPLACE
            ALGORITHM = UNDEFINED VIEW `peta_ra_tp_agg` AS
            select
                `mr`.`id` AS `id_mk_register`,
                `mk`.`id` AS `id_mata_kuliah`,
                `cpl`.`id` AS `id_cpl`,
                `ik`.`id` AS `id_ik`,
                `tp`.`id` AS `id_tp`,
                `mk`.`kode` AS `kode_mata_kuliah`,
                `mk`.`nama` AS `nama_mata_kuliah`,
                `mr`.`tahun_akademik_awal` AS `tahun_akademik_awal`,
                `mr`.`tahun_akademik_akhir` AS `tahun_akademik_akhir`,
                `mr`.`semester` AS `semester`,
                `mr`.`jenis` AS `jenis`,
                `cpl`.`kode` AS `kode_cpl`,
                `ik`.`kode` AS `kode_ik`,
                `tp`.`kode` AS `kode_tp`,
                count(0) AS `jumlah_pemetaan_ra`
            from
                ((((((((`11_MASTER_mk_register` `mr`
            join `07_MASTER_mata_kuliah` `mk` on
                ((`mr`.`07_MASTER_mata_kuliah_id` = `mk`.`id`)))
            join `15_MASTER_rencana_asesmen` `ra` on
                ((`ra`.`11_MASTER_mk_register_id` = `mr`.`id`)))
            join `16_MASTER_peta_ra_tp` `prt` on
                ((`prt`.`15_MASTER_rencana_asesmen_id` = `ra`.`id`)))
            join `13_MASTER_tujuan_pembelajaran` `tp` on
                ((`prt`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)))
            join `14_MASTER_peta_ik_tp` `pik` on
                ((`pik`.`13_MASTER_tujuan_pembelajaran_id` = `tp`.`id`)))
            join `12_MASTER_peta_ik_mk` `pim` on
                ((`pik`.`12_MASTER_peta_ik_mk_id` = `pim`.`id`)))
            join `09_MASTER_indikator_kinerja` `ik` on
                ((`pim`.`09_MASTER_indikator_kinerja_id` = `ik`.`id`)))
            join `08_MASTER_capaian_pembelajaran_lulusan` `cpl` on
                ((`ik`.`08_MASTER_capaian_pembelajaran_lulusan_id` = `cpl`.`id`)))
            group by
                `mr`.`id`,
                `mk`.`id`,
                `cpl`.`id`,
                `ik`.`id`,
                `tp`.`id`,
                `mk`.`kode`,
                `mk`.`nama`,
                `mr`.`tahun_akademik_awal`,
                `mr`.`semester`,
                `mr`.`jenis`,
                `cpl`.`kode`,
                `ik`.`kode`,
                `tp`.`kode`
            order by
                `kode_mata_kuliah`,
                `mr`.`tahun_akademik_awal`,
                `mr`.`semester`,
                `kode_cpl`,
                `kode_ik`,
                `kode_tp`;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS `peta_ra_tp_agg`');
        DB::unprepared('DROP VIEW IF EXISTS `jejaring_rencana_asesmen`');
        DB::unprepared('DROP VIEW IF EXISTS `jejaring_mata_kuliah`');
        DB::unprepared('DROP VIEW IF EXISTS `bobot_tp_agg_on_mk`');
        DB::unprepared('DROP VIEW IF EXISTS `pemetaan_tp_agg_on_ra`');
        DB::unprepared('DROP VIEW IF EXISTS `peta_ik_tp_ra_agg`');
        DB::unprepared('DROP VIEW IF EXISTS `peta_ik_tp_agg`');
    }
}
