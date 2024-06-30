<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE DEFINER=`root`@`%` PROCEDURE `GET_LATEST_ID`(OUT latest_id INT)
            BEGIN
                DECLARE no_rows_found TINYINT DEFAULT 0;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET no_rows_found = 1;

                SET latest_id = NULL;

                SELECT
                    id
                INTO
                    latest_id
                FROM
                    `01_ANALISIS_ketercapaian_mahasiswa`
                ORDER BY
                    id DESC
                LIMIT 1;

                IF no_rows_found THEN
                    SET latest_id = -1;
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`%` PROCEDURE `GET_MATA_KULIAH_INFO`(
                IN id_ra_in INT,
                OUT id_mk_register_out INT,
                OUT id_mata_kuliah_out INT,
                OUT kode_mata_kuliah_out VARCHAR(10),
                OUT nama_mata_kuliah_out VARCHAR(50),
                OUT tahun_akademik_awal_out YEAR,
                OUT tahun_akademik_akhir_out YEAR,
                OUT semester_out INT,
                OUT jenis_out ENUM ("Teori", "Praktikum")
            )
            BEGIN
                SELECT DISTINCT
                    id_mk_register,
                    id_mata_kuliah,
                    kode_mata_kuliah,
                    nama_mata_kuliah,
                    tahun_akademik_awal,
                    tahun_akademik_akhir,
                    semester,
                    jenis INTO id_mk_register_out,
                    id_mata_kuliah_out,
                    kode_mata_kuliah_out,
                    nama_mata_kuliah_out,
                    tahun_akademik_awal_out,
                    tahun_akademik_akhir_out,
                    semester_out,
                    jenis_out
                FROM
                    peta_ik_tp_ra_agg
                WHERE
                    id_ra = id_ra_in;
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`%` PROCEDURE `GET_TOTAL_BOBOT_TP_MK`(
                IN id_mr_in INT,
                IN id_mk_in INT,
                OUT total_bobot_tp_out INT
            )
            BEGIN
                SELECT
                    total_bobot_tp
                INTO
                    total_bobot_tp_out
                FROM
                    bobot_tp_agg_on_mk
                WHERE
                    id_mk_register = id_mr_in
                    AND id_mata_kuliah = id_mk_in;
            END;
        ');

        DB::unprepared('
            CREATE DEFINER=`root`@`%` PROCEDURE `SET_KETERCAPAIAN_TP`(IN nim_mhs VARCHAR(9), IN id_ra_in INT, IN nilai_ra INT)
            BEGIN
                DECLARE id_mkr INT;
                DECLARE id_mk INT;
                DECLARE id_cpl_v INT;
                DECLARE id_ik_v INT;
                DECLARE id_tp_v INT;
                DECLARE kode_mk VARCHAR(10);
                DECLARE kode_cpl_v VARCHAR(10);
                DECLARE kode_ik_v VARCHAR(10);
                DECLARE kode_tp_v VARCHAR(10);
                DECLARE kode_ra_v VARCHAR(10);
                DECLARE nama_mk VARCHAR(50);
                DECLARE thn_akademik_awal YEAR;
                DECLARE thn_akademik_akhir YEAR;
                DECLARE semester_mk INT;
                DECLARE jenis_mk ENUM("Teori", "Praktik");
                DECLARE ketercapaian_tp DECIMAL(4,2);
                DECLARE total_bobot_tp_v DECIMAL(3,0);
                DECLARE jumlah_pemetaan_ra_v INT;
                DECLARE nilai_maksimal_tp INT;
                DECLARE bobot_tp_v DECIMAL(4,2);
                DECLARE done INT DEFAULT 0;

                DECLARE tp_cursor CURSOR FOR
                    SELECT
                        id_cpl,
                        id_ik,
                        id_tp,
                        kode_cpl,
                        kode_ik,
                        kode_tp,
                        bobot_tp
                    FROM
                        peta_ik_tp_ra_agg
                    WHERE
                        id_mk_register = id_mkr
                        AND id_mata_kuliah = id_mk
                        AND id_ra = id_ra_in;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

                CALL GET_MATA_KULIAH_INFO(id_ra_in, id_mkr, id_mk, kode_mk, nama_mk, thn_akademik_awal, thn_akademik_akhir, semester_mk, jenis_mk);

                CALL GET_TOTAL_BOBOT_TP_MK(id_mkr, id_mk, total_bobot_tp_v);

                OPEN tp_cursor;

                tp_loop: LOOP
                    FETCH tp_cursor INTO id_cpl_v, id_ik_v, id_tp_v, kode_cpl_v, kode_ik_v, kode_tp_v, bobot_tp_v;
                    IF done THEN
                        LEAVE tp_loop;
                    END IF;

                    SELECT
                        jumlah_pemetaan_ra
                    INTO
                        jumlah_pemetaan_ra_v
                    FROM
                        pemetaan_tp_agg_on_ra
                    WHERE
                        id_cpl = id_cpl_v
                        AND id_ik = id_ik_v
                        AND id_tp = id_tp_v;

                    SET nilai_maksimal_tp = jumlah_pemetaan_ra_v * 100;
                    SET bobot_tp_v = bobot_tp_v / total_bobot_tp_v * 100;
                    SET ketercapaian_tp = nilai_ra / nilai_maksimal_tp * bobot_tp_v;

                    UPDATE
                        `01_ANALISIS_ketercapaian_mahasiswa`
                    SET
                        ketercapaian_tp = ketercapaian_tp
                    WHERE
                        nim = nim_mhs
                        AND id_mk_register = id_mkr
                        AND id_mata_kuliah = id_mk
                        AND id_cpl = id_cpl_v
                        AND id_ik = id_ik_v
                        AND id_tp = id_tp_v
                        AND id_ra = id_ra_in
                        AND kode_mata_kuliah = kode_mk
                        AND nama_mata_kuliah = nama_mk
                        AND tahun_akademik_awal = thn_akademik_awal
                        AND tahun_akademik_akhir = thn_akademik_akhir
                        AND jenis = jenis_mk;
                END LOOP;

                CLOSE tp_cursor;
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
        DB::unprepared('DROP PROCEDURE IF EXISTS `SET_KETERCAPAIAN_TP`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `GET_TOTAL_BOBOT_TP_MK`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `GET_MATA_KULIAH_INFO`');
        DB::unprepared('DROP PROCEDURE IF EXISTS `GET_LATEST_ID`');
    }
}
