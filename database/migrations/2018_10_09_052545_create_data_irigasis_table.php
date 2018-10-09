<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataIrigasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_irigasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('daerah_irigasi')->nullable();
            $table->string('id_kecamatan')->nullable()->default(0);
            $table->float('areal')->nullable()->default(0);
            $table->float('panjang_saluran_primer')->nullable()->default(0);
            $table->float('panjang_saluran_sekunder')->nullable()->default(0);
            $table->float('panjang_saluran_tersier')->nullable()->default(0);
            $table->float('bangunan_utama_gedung')->nullable()->default(0);
            $table->float('bangunan_utama_pintu_air')->nullable()->default(0);
            $table->float('bangunan_utama_intake')->nullable()->default(0);
            $table->float('pelengkap_box_tersier')->nullable()->default(0);
            $table->float('pelengkap_gorong')->nullable()->default(0);
            $table->float('pelengkap_jembatan')->nullable()->default(0);
            $table->string('sumber_air')->nullable();
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
        Schema::dropIfExists('data_irigasi');
    }
}
