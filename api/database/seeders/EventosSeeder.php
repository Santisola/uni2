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
                'descripcion' => Str::random(250),
                'latitud' => -34.634124,
                'longitud' => -58.493567,
                'desde' => Carbon::parse('2022-09-09 14:30:00'),
                'hasta' => Carbon::parse('2022-09-09 18:30:00'),
                'imagen' => 'https://images.pexels.com/photos/7474354/pexels-photo-7474354.jpeg',
                'publicado' => true,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_evento' => 2,
                'nombre' => Str::random(20),
                'descripcion' => Str::random(250),
                'latitud' => -34.634567,
                'longitud' => -58.493214,
                'desde' => Carbon::parse('2022-09-15 14:30:00'),
                'hasta' => Carbon::parse('2022-09-23 19:30:00'),
                'imagen' => null,
                'publicado' => false,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_evento' => 3,
                'nombre' => Str::random(20),
                'descripcion' => Str::random(250),
                'latitud' => -34.634579,
                'longitud' => -58.493111,
                'desde' => Carbon::parse('2022-11-20 10:00:00'),
                'hasta' => Carbon::parse('2022-11-28 23:30:00'),
                'imagen' => null,
                'publicado' => false,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_evento' => 4,
                'nombre' => Str::random(20),
                'descripcion' => Str::random(250),
                'latitud' => -34.634111,
                'longitud' => -58.493111,
                'desde' => Carbon::parse('2022-11-29 14:30:00'),
                'hasta' => Carbon::parse('2022-11-30 17:30:00'),
                'imagen' => null,
                'publicado' => true,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
