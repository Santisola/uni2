<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertaImgsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('alerta_imgs')->insert([
            [
                'id_alerta_img' => 1,
                'imagen' => 'lazzy-frente.jpg',
                'id_alerta' => 1,
            ],
            [
                'id_alerta_img' => 2,
                'imagen' => 'lazzy-jugando.jpg',
                'id_alerta' => 1,
            ],
            [
                'id_alerta_img' => 3,
                'imagen' => 'lazzy-durmiendo.jpg',
                'id_alerta' => 1,
            ],
            [
                'id_alerta_img' => 4,
                'imagen' => 'perro1.jpg',
                'id_alerta' => 2,
            ],
            [
                'id_alerta_img' => 5,
                'imagen' => 'perro2.jpg',
                'id_alerta' => 2,
            ],
            [
                'id_alerta_img' => 6,
                'imagen' => 'perro3.jpg',
                'id_alerta' => 2,
            ],
            [
                'id_alerta_img' => 7,
                'imagen' => 'ragnar.jpg',
                'id_alerta' => 3,
            ],
            [
                'id_alerta_img' => 8,
                'imagen' => 'ragnar2.jpg',
                'id_alerta' => 3,
            ],
        ]);
    }
}
