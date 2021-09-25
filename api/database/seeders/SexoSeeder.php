<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sexo')->insert([
            [
                'id_sexo' => 1,
                'sexo' => 'Macho',
            ],
            [
                'id_sexo' => 2,
                'sexo' => 'Hembra',
            ],
            [
                'id_sexo' => 3,
                'sexo' => 'Indefinido',
            ],
        ]);
    }
}
