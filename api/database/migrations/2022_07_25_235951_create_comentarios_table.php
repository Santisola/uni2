<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->longText("comentario");

            $table->unsignedBigInteger('id_verificado');
            $table->foreign('id_verificado')->references('id_verificado')->on('usuarios_verificados')->onDelete('cascade');

            $table->unsignedBigInteger('id_noticia');
            $table->foreign('id_noticia')->references('id_noticia')->on('noticias')->onDelete('cascade');

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
        Schema::dropIfExists('comentarios');
    }
}
