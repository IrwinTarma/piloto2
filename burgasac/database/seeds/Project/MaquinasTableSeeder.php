<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaquinasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maquinas = [
            [
            	'nombre'	=> 'Maquina 01',
            ],
            [
            	'nombre'	=> 'Maquina 02',
            ],
            [
            	'nombre'	=> 'Maquina 03',
            ],
            [
            	'nombre'	=> 'Maquina 04',
            ],
            [
            	'nombre'	=> 'Maquina 05',
            ],
        ];

        DB::table('maquinas')->insert($maquinas);
    }
}
