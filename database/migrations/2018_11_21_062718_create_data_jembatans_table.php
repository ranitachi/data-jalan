<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataJembatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_jembatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_kecamatan')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('no_jembatan')->nullable();
            $table->string('no_ruas_jalan')->nullable();
            $table->string('sta_jembatan')->nullable();
            $table->double('vol_panjang_m')->nullable()->default(0);
            $table->double('vol_lebar_m')->nullable()->default(0);
            $table->double('vol_bentang')->nullable()->default(0);
            $table->double('vol_leb')->nullable()->default(0);
            $table->string('kondisi_b')->nullable();
            $table->string('kondisi_s')->nullable();
            $table->string('kondisi_r')->nullable();
            $table->string('kondisi_rb')->nullable();
            $table->string('penanganan')->nullable();
            $table->double('volume')->nullable()->default(0);
            $table->double('biaya_total')->nullable()->default(0);
            $table->double('biaya_pr')->nullable()->default(0);
            $table->double('biaya_pp')->nullable()->default(0);
            $table->double('biaya_rehab')->nullable()->default(0);
            $table->double('biaya_pkt')->nullable()->default(0);
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
        Schema::dropIfExists('data_jembatan');
    }
}
