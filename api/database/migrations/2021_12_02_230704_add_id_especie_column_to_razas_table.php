<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdEspecieColumnToRazasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('razas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_especie');
            $table->foreign('id_especie')->references('id_especie')->on('especies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('razas', function (Blueprint $table) {
            //
        });
    }
}
