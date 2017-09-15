<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedencias = [
            [
            	'nombre'	=> 'Procedencia 01',
            ],
            [
            	'nombre'	=> 'Procedencia 02',
            ],
            [
            	'nombre'	=> 'Procedencia 03',
            ],
            [
            	'nombre'	=> 'Procedencia 04',
            ],
            [
            	'nombre'	=> 'Procedencia 05',
            ],
        ];

        DB::table('procedencias')->insert($procedencias);
    }
}
