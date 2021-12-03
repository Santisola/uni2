<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alertas')->insert([
            [
                'id_alerta' => 1,
                'nombre' => 'Lazzy',
                'fecha' => '2021-11-09',
                'hora' => '23:09',
                'descripcion' => 'Es tamaño mediano, negro, con una mancha blanca en el pecho y las patitas rubias, tiene tatuado el escudo de Boquita en una gamba',
                'imagenes' => 'lazzy-frente.jpg|lazzy-jugando.jpg|lazzy-durmiendo.png',
                'latitud' => -34.632728,
                'longitud' => -58.491996,
                'id_usuario' => 1,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 25,
                'id_tipoalerta' => 2,
            ],
            [
                'id_alerta' => 2,
                'nombre' => null,
                'fecha' => '2021-11-05',
                'hora' => '23:09',
                'descripcion' => 'Es marron, enano y super bueno, medio cachorro. Huele a lavanda',
                'imagenes' => 'perro1.jpg|perro2.jpg|perro3.png',
                'latitud' => -34.633633,
                'longitud' =>  -58.492779,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 40,
                'id_usuario' => 2,
                'id_tipoalerta' => 1,
            ],
        ]);
    }
}
