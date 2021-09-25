<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoalertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tipoalerta')->insert([
            [
                'id_tipoalerta' => 1,
                'tipo' => 'Perdida',
            ],
            [
                'id_tipoalerta' => 2,
                'tipo' => 'Encontrada',
            ]
        ]);
    }
}
