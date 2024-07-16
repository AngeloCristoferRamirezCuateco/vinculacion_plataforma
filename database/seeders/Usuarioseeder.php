<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usuarioseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("usuarios")->insert([
            'id_empresa' => 1,
            'nombreUsuario' => 'John',
            'apellidoPaterno' => 'Doe',
            'apellidoMaterno' => 'Smith',
            'telefonoUsuario' => '1234567890',
            'correoUsuario' => 'john.doe@example.com',
            'evaluacionUsuario' => 5,
            'curriculumUsuario' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
