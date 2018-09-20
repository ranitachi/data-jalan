<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxUpkBkadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_upk_bkad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('desa')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('id_kec')->default(0);
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
        Schema::dropIfExists('trx_upk_bkad');
    }
}
