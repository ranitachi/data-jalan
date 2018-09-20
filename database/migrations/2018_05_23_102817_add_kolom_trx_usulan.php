<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKolomTrxUsulan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trx_usulan', function (Blueprint $table) {
            $table->integer('id_upk_bkad');
            $table->integer('id_kpm');
            $table->double('total_dana');
            $table->double('total_unit_rtlh');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trx_usulan', function (Blueprint $table) {
            //
        });
    }
}
