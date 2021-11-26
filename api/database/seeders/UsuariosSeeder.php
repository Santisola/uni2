<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            [
                'id_usuario' => 1,
                'nombre' => 'Santiago Isola',
                'email' => 'isolasantiago@gmail.com',
                'password' => Hash::make('123456'),
                'imagen' => null,
                'telefono' => '541150268860'
            ],
            [
                'id_usuario' => 2,
                'nombre' => 'Lucas Cámpora',
                'email' => 'lucasmartincampora@gmail.com',
                'password' => Hash::make('123456'),
                'imagen' => null,
                'telefono' => '541163674462'
            ],
            [
                'id_usuario' => 3,
                'nombre' => 'Matias Bubello',
                'email' => 'matias.bubello@davinci.edu.ar',
                'password' => Hash::make('123456'),
                'imagen' => null,
                'telefono' => '541167246466'
            ],
        ]);
    }
}
