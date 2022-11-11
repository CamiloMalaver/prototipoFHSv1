<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'codigo' => 1,
            'nombre_rol' => 'Administrador',
        ]);

        DB::table('rol')->insert([
            'codigo' => 2,
            'nombre_rol' => 'Auditor',
        ]);

        DB::table('rol')->insert([
            'codigo' => 3,
            'nombre_rol' => 'Docente',
        ]);

        DB::table('estado')->insert([
            'valor' => 1,
        ]);

        DB::table('estado')->insert([
            'valor' => 0,
        ]);

        DB::table('users')->insert([
            'documento' => 000000001,
            'nombres' => 'Administrador',
            'apellidos' =>'Administrador',
            'celular' => 3120000000,
            'rol_id' => 1,
            'email' => 'admin@admin.io',
            'password' => Hash::make('admin'),
            'estado_id' => 1,
        ]);

        DB::table('programa')->insert([
            'codigo' => 5005,
            'nombre' => 'Default',
        ]);

    }
}
