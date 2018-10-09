<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSitusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_situ', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_situ')->nullable();
            $table->integer('id_kecamatan')->nullable()->default(0);
            $table->integer('id_kelurahan')->nullable()->default(0);
            $table->string('das')->nullable();
            $table->float('luas_asal')->nullable()->default(0);
            $table->float('luas_sekarang')->nullable()->default(0);
            $table->integer('pengelolaan_pusat')->nullable()->default(0);
            $table->integer('pengelolaan_provinsi')->nullable()->default(0);
            $table->integer('pengelolaan_kabupaten')->nullable()->default(0);
            $table->string('kondisi')->nullable();
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
        Schema::dropIfExists('data_situ');
    }
}
