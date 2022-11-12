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
            'nombre' => 'Aprobado',
        ]);

        DB::table('estado')->insert([
            'nombre' => 'En revision',
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
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 2744775271,
            'nombres' => 'Angie',
            'apellidos' =>'Daza',
            'celular' => 3125698784,
            'rol_id' => 2,
            'email' => 'r4g44rgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 27766271,
            'nombres' => 'Daniel',
            'apellidos' =>'Sanchez',
            'celular' => 3125858784,
            'rol_id' => 2,
            'email' => 'r4grgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 27753271,
            'nombres' => 'Hugo',
            'apellidos' =>'Perez',
            'celular' => 3125896784,
            'rol_id' => 2,
            'email' => 'r4grgddn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 277527441,
            'nombres' => 'Sergio',
            'apellidos' =>'Diaz',
            'celular' => 3125698784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grfdsgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 277415271,
            'nombres' => 'Ana Maria',
            'apellidos' =>'Lobo',
            'celular' => 3125638784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grddgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 2775274441,
            'nombres' => 'Carlos',
            'apellidos' =>'Diaz',
            'celular' => 3155698784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grfdres@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 277526671,
            'nombres' => 'Luis',
            'apellidos' =>'Boris',
            'celular' => 3128328784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4madsgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 26635271,
            'nombres' => 'Saul',
            'apellidos' =>'Martinez',
            'celular' => 3188698784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grfdegn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 2775277471,
            'nombres' => 'Diana',
            'apellidos' =>'Fandiño',
            'celular' => 3125678784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grffansgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 2766575271,
            'nombres' => 'Paul',
            'apellidos' =>'Jones',
            'celular' => 3125999784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4grfdsg12n@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 277225271,
            'nombres' => 'Victor',
            'apellidos' =>'Diaz',
            'celular' => 312588784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'vdiaz@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);

        DB::table('users')->insert([
            'documento' => 277555271,
            'nombres' => 'Serdedgio',
            'apellidos' =>'Didez',
            'celular' => 3126398784,
            'rol_id' => 3,
            'programa_id' => 1,
            'email' => 'r4gderfdsgn@admin.io',
            'password' => Hash::make('secret'),
            'estado_id' => 1,
        ]);       

    }
}
