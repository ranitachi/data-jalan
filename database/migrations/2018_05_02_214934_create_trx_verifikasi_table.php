<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxVerifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_verifikasi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_usulan');
            $table->integer('atap');
            $table->integer('lantai');
            $table->integer('dinding');
            $table->integer('septictank');
            $table->integer('wc');
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
        Schema::dropIfExists('trx_verifikasi');
    }
}
