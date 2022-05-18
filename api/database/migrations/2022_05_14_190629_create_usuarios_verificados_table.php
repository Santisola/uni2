<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosVerificadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_verificados', function (Blueprint $table) {
            $table->id('id_verificado')->unsigned();
            $table->bigInteger('cuit')->unique();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->bigInteger('telefono')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('imagen')->nullable();
            $table->boolean('status')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_verificados');
    }
}
