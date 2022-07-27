<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacto')->insert([
           [
               'id_contacto' => 1,
               'asunto' => 'otro',
               'mensaje' => 'Mensaje desde el seeder',
               'id_verificado' => 1,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s')
           ]
        ]);
    }
}
