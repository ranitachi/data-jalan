<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRumahkumusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_rumahkumuh', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kecamatan')->default(0);
            $table->text('alamat')->nullable();
            $table->integer('status_kesejahteraan')->default(0);
            $table->string('nama_kk')->nullable();
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
        Schema::dropIfExists('trx_rumahkumuh');
    }
}
