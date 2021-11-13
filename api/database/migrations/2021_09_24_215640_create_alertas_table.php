<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('id_alerta')->unsigned();
            $table->string('nombre')->nullable();
            $table->text('descripcion');
            $table->string('fecha');
            $table->string('hora');
            $table->text('imagenes');
            $table->decimal('latitud', 8, 6);
            $table->decimal('longitud', 8, 6);

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
        Schema::dropIfExists('alertas');
    }
}
