<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_verified', function (Blueprint $table) {
            $table->increments('id');
            $table->string('enumerator')->nullable();
            $table->date('tanggal_submit')->nullable();
            $table->integer('no_bnba')->nullable();
            $table->string('jenis_atap')->nullable();
            $table->string('kondisi_atap')->nullable();
            $table->string('jenis_bangunan')->nullable();
            $table->string('kondisi_bangunan')->nullable();
            $table->string('jenis_dinding')->nullable();
            $table->string('kondisi_dinding')->nullable();
            $table->string('jenis_kakus')->nullable();
            $table->string('kondisi_kakus')->nullable();
            $table->integer('luas_lahan')->nullable();
            $table->string('status_lahan')->nullable();
            $table->text('foto_rumah')->nullable();
            $table->text('foto_fisik_bangunan_1')->nullable();
            $table->text('foto_fisik_bangunan_2')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longtitude')->nullable();
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
        Schema::dropIfExists('trx_verified');
    }
}
