<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('noticias')->insert([
            [
                'id_noticia' => 1,
                'titulo' => 'Día Mundial del Perro Adoptado',
                'contenido' => "23 de septiembre: Día Mundial del Perro Adoptado, ¿qué motivó la celebración de esta efeméride? \n
                                  Miles de perros vagan sin rumbo por las calles y los menos afortunados acaban sacrificados en una perrera. Ellos son héroes con cuatro patas que, con un golpe de suerte, viven con una familia en la que son uno más, un 'hijo' adoptado. Sin embargo, otros muchos viven en perreras esperando ser acogidos por alguien que les de amor. \n
                                  La celebración nace con la intención de concienciar a la población sobre el abandono de animales domésticos y la importancia de adoptar perros y gatos en vez de comprarlos. Porque todos merecemos una segunda oportunidad, y por supuesto, es necesario mentalizarse de que tener un animal doméstico conlleva una responsabilidad. \n
                                  Adoptar una mascota es una decisión individual y conlleva un proceso delicado, sobre todo en lo que tiene que ver con la adaptación del perro a su nueva familia y su nuevo entorno. \n
                                  Se debe evitar a toda costa el abandono de animales, ya que se les condena a vivir el resto de su vida en un refugio o en el peor de los casos a ser sacrificados. \n
                                  Tú puedes cambiarle la vida a un perro, pero él seguro que también te la cambia a ti.",
                'imagen' => 'https://cdn.pixabay.com/photo/2022/04/24/16/06/nature-7153955_960_720.jpg',
                'slug' => 'dia-mundial-del-perro-adoptado',
                'publicado' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
