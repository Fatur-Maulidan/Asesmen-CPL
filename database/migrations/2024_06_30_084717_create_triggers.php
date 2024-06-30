<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`root`@`%` TRIGGER `map_mahasiswa` AFTER INSERT ON `11_MASTER_mk_register` FOR EACH ROW BEGIN
                DECLARE id_mk BIGINT UNSIGNED;
                DECLARE id_kurikulum BIGINT UNSIGNED;
                DECLARE id_prodi BIGINT UNSIGNED;
                DECLARE nim_mhs VARCHAR(9);
                DECLARE done INT default 0;

                DECLARE mahasiswa_cursor CURSOR FOR
                    SELECT
                        nim
                    FROM
                        `06_MASTER_mahasiswa`
                    WHERE
                        `03_MASTER_kurikulum_id` = id_kurikulum
                        AND status = "Aktif";

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

                SELECT
                    `07_MASTER_mata_kuliah_id`
                INTO
                    id_mk
                FROM
                    `11_MASTER_mk_register`
                WHERE
                    id = NEW.id;

                SELECT
                    `03_MASTER_kurikulum_id`
                INTO
                    id_kurikulum
                FROM
                    `07_MASTER_mata_kuliah`
                WHERE
                    id = id_mk;

                OPEN mahasiswa_cursor;

                mahasiswa_loop: LOOP
                    FETCH mahasiswa_cursor INTO nim_mhs;
                    IF done THEN
                        LEAVE mahasiswa_loop;
                    END IF;

                    INSERT INTO
                        `18_MASTER_mahasiswa_perkuliahan` (`06_MASTER_mahasiswa_nim`, `11_MASTER_mk_register_id`)
                    VALUES
                        (nim_mhs, NEW.id);

                END LOOP;

                CLOSE mahasiswa_cursor;
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`%` TRIGGER `SP_update` AFTER UPDATE ON `19_MASTER_nilai_mahasiswa` FOR EACH ROW BEGIN
                CALL SET_KETERCAPAIAN_TP(OLD.`06_MASTER_mahasiswa_nim`, OLD.`15_MASTER_rencana_asesmen_id`, NEW.nilai);
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`%` TRIGGER `KTTP_mapping` AFTER INSERT ON `19_MASTER_nilai_mahasiswa` FOR EACH ROW BEGIN
                DECLARE id_mk BIGINT UNSIGNED;
                DECLARE id_mr BIGINT UNSIGNED;
                DECLARE id_cpl_v BIGINT UNSIGNED;
                DECLARE id_ik_v BIGINT UNSIGNED;
                DECLARE id_tp_v BIGINT UNSIGNED;
                DECLARE id_ra_v BIGINT UNSIGNED;
                DECLARE kode_mk VARCHAR(10);
                DECLARE kode_cpl_v VARCHAR(10);
                DECLARE kode_ik_v VARCHAR(10);
                DECLARE kode_tp_v VARCHAR(10);
                DECLARE kode_ra_v VARCHAR(10);
                DECLARE nama_mk VARCHAR(500);
                DECLARE tahun_akademik_awal_mk YEAR;
                DECLARE tahun_akademik_akhir_mk YEAR;
                DECLARE semester_mk TINYINT UNSIGNED;
                DECLARE jenis_mk ENUM("Teori", "Jenis");
                DECLARE done INT DEFAULT 0;

                DECLARE jejaring_cursor CURSOR FOR
                    SELECT
                        DISTINCT id_mk_register,
                        id_mata_kuliah,
                        id_cpl,
                        id_ik,
                        id_tp,
                        id_ra,
                        kode_mata_kuliah,
                        nama_mata_kuliah,
                        tahun_akademik_awal,
                        tahun_akademik_akhir,
                        semester,
                        jenis,
                        kode_cpl,
                        kode_ik,
                        kode_tp,
                        kode_ra
                    FROM
                        peta_ik_tp_ra_agg
                    WHERE
                        id_ra = NEW.`15_MASTER_rencana_asesmen_id`;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

                OPEN jejaring_cursor;

                jejaring_loop:LOOP
                    FETCH
                        jejaring_cursor
                    INTO
                        id_mr,
                        id_mk,
                        id_cpl_v,
                        id_ik_v,
                        id_tp_v,
                        id_ra_v,
                        kode_mk,
                        nama_mk,
                        tahun_akademik_awal_mk,
                        tahun_akademik_akhir_mk,
                        semester_mk,
                        jenis_mk,
                        kode_cpl_v,
                        kode_ik_v,
                        kode_tp_v,
                        kode_ra_v;

                    IF done THEN
                        LEAVE jejaring_loop;
                    END IF;

                    INSERT INTO
                        `01_ANALISIS_ketercapaian_mahasiswa` (
                            `nim`,
                            `id_mata_kuliah`,
                            `id_mk_register`,
                            `id_cpl`,
                            `id_ik`,
                            `id_tp`,
                            `id_ra`,
                            `kode_mata_kuliah`,
                            `nama_mata_kuliah`,
                            `tahun_akademik_awal`,
                            `tahun_akademik_akhir`,
                            `semester`,
                            `jenis`,
                            `kode_cpl`,
                            `kode_ik`,
                            `kode_tp`,
                            `kode_ra`
                        )
                    VALUES
                        (
                            NEW.`06_MASTER_mahasiswa_nim`,
                            id_mk,
                            id_mr,
                            id_cpl_v,
                            id_ik_v,
                            id_tp_v,
                            id_ra_v,
                            kode_mk,
                            nama_mk,
                            tahun_akademik_awal_mk,
                            tahun_akademik_akhir_mk,
                            semester_mk,
                            jenis_mk,
                            kode_cpl_v,
                            kode_ik_v,
                            kode_tp_v,
                            kode_ra_v
                        );
                END LOOP;

                CLOSE jejaring_cursor;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `KTTP_mapping`');
        DB::unprepared('DROP TRIGGER IF EXISTS `SP_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `map_mahasiswa`');
    }
}
