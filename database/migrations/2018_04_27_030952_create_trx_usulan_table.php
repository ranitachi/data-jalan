<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxUsulanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * status => 0 belum di verifikasi, 1 data valid, 2 data tidak valid
         */

        Schema::create('trx_usulan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan');
            $table->integer('no_bnba');
            $table->string('penerima');
            $table->string('alamat');
            $table->string('jenis_kegiatan');
            $table->string('dana_pk_rumah');
            $table->string('dana_pemb_wc');
            $table->string('dana_bop_keg');
            $table->string('dana_total');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('trx_usulan');
    }
}
