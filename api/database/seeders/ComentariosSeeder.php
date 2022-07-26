<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComentariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comentarios')->insert([
           [
               'id_comentario' => 1,
               'comentario' => 'Este es un comentario del seeder',
               'id_verificado' => 1,
               'id_noticia' => 1,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
           ],
            [
               'id_comentario' => 2,
               'comentario' => 'Este es el segundo comentario del seeder',
               'id_verificado' => 1,
               'id_noticia' => 1,
               'created_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
               'updated_at' => Carbon::now('UTC')->format('Y-m-d H:i:s'),
           ],
        ]);
    }
}
