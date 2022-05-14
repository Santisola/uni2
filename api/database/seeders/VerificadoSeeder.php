<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_verificados')->insert([
           [
               'id_verificado' => 1,
               'nombre' => 'Matías',
               'apellido' => 'Bubello',
               'email' => 'matias.bubello@davinci.edu.ar',
               'password' => '1234',
               'imagen' => null
           ],
        ]);
    }
}
