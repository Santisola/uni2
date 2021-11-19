<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUsuarioColumnToAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alertas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

            $table->unsignedBigInteger('id_especie');
            $table->foreign('id_especie')->references('id_especie')->on('especies');

            $table->unsignedBigInteger('id_raza');
            $table->foreign('id_raza')->references('id_raza')->on('razas');

            $table->unsignedBigInteger('id_sexo')->nullable();
            $table->foreign('id_sexo')->references('id_sexo')->on('sexo');

            $table->unsignedBigInteger('id_tipoalerta');
            $table->foreign('id_tipoalerta')->references('id_tipoalerta')->on('tipoalerta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alertas', function (Blueprint $table) {
            //
        });
    }
}
