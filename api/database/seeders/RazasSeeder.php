<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RazasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('razas')->insert([
            [
                'id_raza' => 1,
                'raza' => 'Labrador Retriever'
            ],
            [
                'id_raza' => 2,
                'raza' => 'Border Collie'
            ],
            [
                'id_raza' => 3,
                'raza' => 'Bichón Maltés'
            ],
            [
                'id_raza' => 4,
                'raza' => 'Pitbull'
            ],
            [
                'id_raza' => 5,
                'raza' => 'Pastor Alemán'
            ],
            [
                'id_raza' => 6,
                'raza' => 'Yorkshire Terrier'
            ],
        ]);
    }
}
