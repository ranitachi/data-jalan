<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFotoToIrigasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_irigasi', function (Blueprint $table) {
            $table->text('foto_1')->after('sumber_air')->nullable();
            $table->text('foto_2')->after('foto_1')->nullable();
            $table->text('foto_3')->after('foto_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_irigasi', function (Blueprint $table) {
            $table->dropColumn('foto_1');
            $table->dropColumn('foto_2');
            $table->dropColumn('foto_3');
        });
    }
}
