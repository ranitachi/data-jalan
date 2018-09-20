<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrxStrukturKpmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_struktur_kpm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ketua')->nullable();
            $table->integer('flag')->default(1);
            $table->integer('id_kpm')->default(0);
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
        Schema::dropIfExists('trx_struktur_kpm');
    }
}
