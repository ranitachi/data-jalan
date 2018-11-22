<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataJalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_jalan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan')->default(0);
            $table->string('nama_jalan')->nullable();
            $table->string('no_ruas')->nullable();
            $table->float('vol_panjang_km')->default(0);
            $table->float('vol_lebar_m')->default(0);
            $table->double('luas_jalan_m_2')->default(0);
            $table->float('type_kons_beton')->default(0);
            $table->float('type_kons_aspal')->default(0);
            $table->float('type_kons_dll')->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('data_jalan');
    }
}
