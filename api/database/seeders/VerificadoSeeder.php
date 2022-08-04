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
               'razon_social' => 'Matías Ezequiel Bubello',
               'nombre' => null,
               'email' => 'matias.bubello@davinci.edu.ar',
               'password' => Hash::make('123456'),
               'imagen' => null,
               'status' => false,
               'deleted_at' => null,
               'telefono' => null,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
           ],
            [
               'id_verificado' => 2,
               'cuit' => 20390657464,
               'razon_social' => 'Lucas Martin Campora',
               'nombre' => null,
               'email' => 'lucas.campora@davinci.edu.ar',
               'password' => Hash::make('123456'),
               'imagen' => null,
               'status' => false,
               'deleted_at' => null,
               'telefono' => null,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
           ],
            [
               'id_verificado' => 3,
               'cuit' => 20434417784,
               'razon_social' => 'Santiago Martin Campora',
               'nombre' => null,
               'email' => 'santiago.isola@davinci.edu.ar',
               'password' => Hash::make('123456'),
               'imagen' => null,
               'status' => false,
               'deleted_at' => null,
               'telefono' => null,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
           ],
        ]);
    }
}
