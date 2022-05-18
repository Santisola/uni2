<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
               'cuit' => 20389958043,
               'nombre' => 'Matías',
               'apellido' => 'Bubello',
               'email' => 'matias.bubello@davinci.edu.ar',
               'password' => Hash::make('1234'),
               'imagen' => null,
               'status' => false,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
           ],
        ]);
    }
}
