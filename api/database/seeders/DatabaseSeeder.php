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
        // \App\Models\User::factory(10)->create();
        $this->call(EspeciesSeeder::class);
        $this->call(RazasSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(TipoalertaSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(AlertasSeeder::class);
    }
}
