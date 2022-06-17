<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'id_admin' => 1,
                'nombre' => 'Matías',
                'email' => 'matias.bubello@davinci.edu.ar',
                'password' => Hash::make(123456),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_admin' => 2,
                'nombre' => 'Santiago',
                'email' => 'santiago.isola@davinci.edu.ar',
                'password' => Hash::make(123456),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_admin' => 3,
                'nombre' => 'Lucas',
                'email' => 'lucas.campora@davinci.edu.ar',
                'password' => Hash::make(123456),
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

    }
}
