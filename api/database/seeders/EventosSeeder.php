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
                'desde' => Carbon::parse('2022-09-09 14:30:00'),
                'hasta' => Carbon::parse('2022-09-09 14:30:00'),
                'publicado' => true,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_evento' => 2,
                'nombre' => Str::random(20),
                'descripcion' => Str::random(250),
                'desde' => Carbon::parse('2022-09-09 14:30:00'),
                'hasta' => Carbon::parse('2022-09-09 14:30:00'),
                'publicado' => false,
                'id_verificado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
