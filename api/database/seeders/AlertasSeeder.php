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
                'descripcion' => 'Es tamaño mediano, rubio, con una mancha blanca en el pecho y las patitas blancas.',
                'imagenes' => '',
                'latitud' => -34.632728,
                'longitud' => -58.491996,
                'id_usuario' => 1,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 25,
                'id_tipoalerta' => 2,
                'finalizada' => false,
            ],
            [
                'id_alerta' => 2,
                'nombre' => null,
                'fecha' => '2021-11-05',
                'hora' => '23:09',
                'descripcion' => 'Es marron, enano y super bueno, medio cachorro. Huele a lavanda',
                'imagenes' => '',
                'latitud' => -34.633633,
                'longitud' =>  -58.492779,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 40,
                'id_usuario' => 2,
                'id_tipoalerta' => 1,
                'finalizada' => false,
            ],
            [
                'id_alerta' => 3,
                'nombre' => 'Ragnar',
                'fecha' => '2021-12-28',
                'hora' => '17:09',
                'descripcion' => 'Es marron, grandote y super bueno, medio cachorron. Ladra mucho',
                'imagenes' => '',
                'latitud' => -34.611120,
                'longitud' =>  -58.520410,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 1,
                'id_usuario' => 1,
                'id_tipoalerta' => 2,
                'finalizada' => true,
            ],
            [
                'id_alerta' => 4,
                'nombre' => 'Tommy',
                'fecha' => '2022-07-18',
                'hora' => '20:01',
                'descripcion' => 'Es un beagle blanco, negro y marron, muy mimoso y tranquilo. Está sin collar. Es cachorro',
                'imagenes' => '',
                'latitud' => -34.619841,
                'longitud' => -58.500350,
                'id_usuario' => 3,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 2,
                'id_tipoalerta' => 2,
                'finalizada' => false,
            ],
            [
                'id_alerta' => 5,
                'nombre' => null,
                'fecha' => '2022-08-02',
                'hora' => '13:39',
                'descripcion' => 'Es flaquito y miedoso, tamaño mediano y color polenta',
                'imagenes' => '',
                'latitud' => -34.619115,
                'longitud' => -58.513758,
                'id_usuario' => 2,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 1,
                'id_tipoalerta' => 1,
                'finalizada' => false,
            ],
            [
                'id_alerta' => 6,
                'nombre' => 'Titán',
                'fecha' => '2022-06-11',
                'hora' => '07:20',
                'descripcion' => 'Es todo marrón con el hocico negro con algunas canas. Tiene collar violeta',
                'imagenes' => '',
                'latitud' => -34.616863,
                'longitud' => -58.461866,
                'id_usuario' => 1,
                'id_especie' => 1,
                'id_sexo' => 1,
                'id_raza' => 6,
                'id_tipoalerta' => 2,
                'finalizada' => false,
            ],
            [
                'id_alerta' => 7,
                'nombre' => null,
                'fecha' => '2022-08-04',
                'hora' => '14:46',
                'descripcion' => 'Es una caniche blanca y chiquita con el pelo cortito. Tiene un arnes de colores.',
                'imagenes' => '',
                'latitud' => -34.609152,
                'longitud' => -58.480788,
                'id_usuario' => 3,
                'id_especie' => 1,
                'id_sexo' => 2,
                'id_raza' => 13,
                'id_tipoalerta' => 1,
                'finalizada' => false,
            ],
        ]);
    }
}
