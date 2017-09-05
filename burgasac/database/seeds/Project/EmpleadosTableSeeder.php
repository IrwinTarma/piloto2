<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleados = [
            [
            	'nombres'			=> 'Juan',
	            'apellidos'			=> 'Perez',
            ],
            [
                'nombres'           => 'Carla',
                'apellidos'         => 'Duran',
            ],
            [
                'nombres'           => 'Hector',
                'apellidos'         => 'Espinoza',
            ],
            [
                'nombres'           => 'Claudia',
                'apellidos'         => 'Medrano',
            ],
            [
                'nombres'           => 'Julio',
                'apellidos'         => 'Farfan',
            ],
        ];

        DB::table('empleados')->insert($empleados);
    }
}
