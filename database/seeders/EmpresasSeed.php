<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Empresas')->insert([
            [
                'nombreEmpresa' => 'Empresa A',
                'tipoEmpresa' => 'Tecnología',
                'fechaCreacion' => '2000-01-01',
                'areaEmpresa' => 'Desarrollo de Software',
                'representanteEmpresa' => 'John Doe',
                'direccionEmpresa' => '123 Main St, Ciudad, País',
                'rfcEmpresa' => 'RFC123456789',
                'evaluacionEmpresa' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombreEmpresa' => 'Empresa B',
                'tipoEmpresa' => 'Consultoría',
                'fechaCreacion' => '2005-05-15',
                'areaEmpresa' => 'Consultoría Empresarial',
                'representanteEmpresa' => 'Jane Smith',
                'direccionEmpresa' => '456 Elm St, Ciudad, País',
                'rfcEmpresa' => 'RFC987654321',
                'evaluacionEmpresa' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombreEmpresa' => 'Empresa C',
                'tipoEmpresa' => 'Manufactura',
                'fechaCreacion' => '2010-09-10',
                'areaEmpresa' => 'Producción de Equipos',
                'representanteEmpresa' => 'Alice Johnson',
                'direccionEmpresa' => '789 Oak St, Ciudad, País',
                'rfcEmpresa' => 'RFC123987456',
                'evaluacionEmpresa' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
