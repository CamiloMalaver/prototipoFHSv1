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
            'nombre' => 'Pendiente',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'Aprobado',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'Rechazado',
        ]);

        DB::table('programa')->insert([
            'codigo' => 5005,
            'nombre' => 'Default',
        ]);

        DB::table('tipo_funcion')->insert([
            'nombre' => 'Investigaciones',
        ]);

        DB::table('tipo_funcion')->insert([
            'nombre' => 'Asesorias',
        ]);

        DB::table('tipo_funcion')->insert([
            'nombre' => 'Proyecto de grado I',
        ]);

        DB::table('users')->insert([
            'documento' => 000000001,
            'nombres' => 'Administrador',
            'apellidos' =>'Administrador',
            'celular' => 3120000000,
            'rol_id' => 1,
            'email' => 'admin@admin.io',
            'password' => Hash::make('admin'),
        ]);

        DB::table('users')->insert([
            'documento' => 2744775271,
            'nombres' => 'Angie',
            'apellidos' =>'Daza',
            'celular' => 3125698784,
            'rol_id' => 2,
            'email' => 'adaza@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 27766271,
            'nombres' => 'Daniel',
            'apellidos' =>'Sanchez',
            'celular' => 3125858784,
            'rol_id' => 2,
            'email' => 'dsanchez@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 27753271,
            'nombres' => 'Hugo',
            'apellidos' =>'Perez',
            'celular' => 3125896784,
            'rol_id' => 2,
            'email' => 'hperez@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 277527441,
            'nombres' => 'Sergio',
            'apellidos' =>'Diaz',
            'celular' => 3125698784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'sdiazn@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 277415271,
            'nombres' => 'Ana Maria',
            'apellidos' =>'Lobo',
            'celular' => 3125638784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'alobo@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 2775274441,
            'nombres' => 'Carlos',
            'apellidos' =>'Diaz',
            'celular' => 3155698784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'cdiaz@hfs.io',
            'password' => Hash::make('secret'),
        ]);

        DB::table('users')->insert([
            'documento' => 277526671,
            'nombres' => 'Luis',
            'apellidos' =>'Boris',
            'celular' => 3128328784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'lboris@hfs.io',
            'password' => Hash::make('secret'),
        ]);    

    }
}
