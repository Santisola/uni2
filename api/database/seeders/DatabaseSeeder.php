<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EspeciesSeeder::class);
        $this->call(RazasSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(TipoalertaSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(AlertasSeeder::class);
        $this->call(AlertaImgsSeeder::class);
        $this->call(VerificadoSeeder::class);
        $this->call(EventosSeeder::class);
        $this->call(NoticiasSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ComentariosSeeder::class);
        $this->call(ContactoSeeder::class);
    }
}
