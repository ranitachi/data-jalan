<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSungaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sungai', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_sungai')->nullable();
            $table->double('areal')->nullable()->default(0);
            $table->string('jenis')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('id_kecamatan')->nullable();
            $table->double('panjang_sungai_primer')->nullable()->default(0);
            $table->double('panjang_sungai_sekunder')->nullable()->default(0);
            $table->double('panjang_sungai_tersier')->nullable()->default(0);
            $table->double('bangunan_utama_bendung')->nullable()->default(0);
            $table->double('bangunan_utama_pintu_air')->nullable()->default(0);
            $table->double('bangunan_utama_bagi_sadap')->nullable()->default(0);
            $table->double('bangunan_terlengkap_box_tersier')->nullable()->default(0);
            $table->double('bangunan_terlengkap_box_gorong')->nullable()->default(0);
            $table->double('bangunan_terlengkap_box_jembatan')->nullable()->default(0);
            $table->double('saluran_bendung')->nullable()->default(0);
            $table->double('saluran_tanah')->nullable()->default(0);
            $table->double('sudah_dibangun_bendung')->nullable()->default(0);
            $table->double('sudah_dibangun_pintu_air')->nullable()->default(0);
            $table->double('sudah_dibangun_bagi_sadap')->nullable()->default(0);
            $table->double('sudah_dibangun_box_tersier')->nullable()->default(0);
            $table->double('sudah_dibangun_gorong')->nullable()->default(0);
            $table->double('sudah_dibangun_jembatan')->nullable()->default(0);
            $table->double('sudah_dibangun_pasangan')->nullable()->default(0);
            $table->double('sudah_dibangun_tanah')->nullable()->default(0);
            $table->double('sisa')->nullable()->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_sungai');
    }
}
