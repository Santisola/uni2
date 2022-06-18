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
               'razon_social' => 'Matías Bubello',
               'email' => 'matias.bubello@davinci.edu.ar',
               'password' => Hash::make('1234'),
               'imagen' => null,
               'status' => false,
               'deleted_at' => null,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
           ],
        ]);
    }
}
