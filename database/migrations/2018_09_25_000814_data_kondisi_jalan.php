<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataKondisiJalan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kondisi_jalan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_data_jalan')->default(0);
            $table->float('kondisi_b')->nullable();
            $table->float('kondisi_s')->nullable();
            $table->float('kondisi_r')->nullable();
            $table->float('kondisi_r_b')->nullable();
            $table->float('persentase_rusak')->nullable();
            $table->string('jenis')->nullable();
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
        Schema::dropIfExists('data_kondisi_jalan');
    }
}
