<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventos')->insert([
            [
                'id_evento' => 1,
                'nombre' => 'Día de adopción',
                'descripcion' => "La Jornada de Concientización sobre la Adopción de Mascotas es un evento donde participan más de 75 ONGs que dan a conocer su labor, y a los perros y gatos que están en adopción. Además se reciben donaciones y se podrán incorporar nuevos voluntarios.",
                'latitud' => -34.60673136266081,
                'longitud' => -58.43558329957035,
                'direccion' => 'Av. Díaz Vélez, C1414 CABA',
                'desde' => Carbon::parse('2022-09-09 14:30:00'),
                'hasta' => Carbon::parse('2022-09-09 18:30:00'),
                'imagen' => 'public/imgs/eventos/veterinario.jpg',
                'publicado' => true,
                'id_verificado' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ],
            [
                'id_evento' => 2,
                'nombre' => 'Buscamos nuevos voluntarios',
                'descripcion' => 'Si sos amante de las mascotas y querés transformar el mundo de los más indefensos ¡Este es el momento! Estamos buscando voluntarios para que puedan ayudarnos a ayudar a estos hermosos seres de 4 patas. Vos podés hacer el cambio. Te esperamos en Plaza Serrano el día 15 de Septiembre las 14:30hs. Estaremos alli todos los días hasta el 23 de Septiembre. ¡No faltes!',
                'latitud' => -34.58873379281573,
                'longitud' => -58.43021050197954,
                'direccion' => 'Plaza Serrano, CABA',
                'desde' => Carbon::parse('2022-09-15 14:30:00'),
                'hasta' => Carbon::parse('2022-09-23 19:30:00'),
                'imagen' => 'public/imgs/eventos/voluntario.jpeg',
                'publicado' => false,
                'id_verificado' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ],
            [
                'id_evento' => 3,
                'nombre' => 'Baño gratis',
                'descripcion' => 'Estamos dando baños gratis a los peluditos de la calle. También podés traer al tuyo y conocernos.',
                'latitud' => -34.634579,
                'longitud' => -58.493111,
                'direccion' => 'Calle 1234',
                'desde' => Carbon::parse('2022-11-20 10:00:00'),
                'hasta' => Carbon::parse('2022-11-28 23:30:00'),
                'imagen' => 'public/imgs/eventos/shower.jpg',
                'publicado' => false,
                'id_verificado' => 1,
                'deleted_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ],
            [
                'id_evento' => 4,
                'nombre' => "¡Revisión médica gratuita para tu mascota!",
                'descripcion' => "Al igual que las personas, las mascotas necesitan una buena alimentación, ejercicio y un chequeo médico periódico para cuidar su salud. Desde cachorros hasta la vejez, mantener una rutina anual es vital para prevenir y detectar enfermedades. Un pronóstico precoz, además, garantiza un tratamiento más sencillo, una recuperación más rápida y un ahorro en los gastos veterinarios. Por estas razones, es importante no olvidar la cita para llevar a las mascotas a su chequeo médico de todos los años.",
                'latitud' => -34.634111,
                'longitud' => -58.493111,
                'direccion' => 'Bacacay 4719',
                'desde' => Carbon::parse('2022-11-29 14:30:00'),
                'hasta' => Carbon::parse('2022-11-30 17:30:00'),
                'imagen' => 'public/imgs/eventos/cachorrito.jpg',
                'publicado' => true,
                'id_verificado' => 1,
                'deleted_at' => null,
                'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
