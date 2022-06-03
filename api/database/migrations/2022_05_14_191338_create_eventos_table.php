<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id('id_evento');
            $table->string('nombre');
            $table->longText('descripcion');
            $table->decimal('latitud', 8, 6);
            $table->decimal('longitud', 8, 6);
            $table->timestamp('desde')->useCurrent();
            $table->timestamp('hasta')->useCurrent();
            $table->string('imagen')->nullable();
            $table->boolean('publicado');

            $table->unsignedBigInteger('id_verificado');
            $table->foreign('id_verificado')->references('id_verificado')->on('usuarios_verificados');

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
        Schema::dropIfExists('eventos');
    }
}
