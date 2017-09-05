<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titulos = [
            [
            	'nombre'	=> 'Titulo Accesorio 01',
                'materia_prima'    => 'accesorio',
            ],
            [
            	'nombre'	=> 'Titulo Accesorio 02',
                'materia_prima'    => 'accesorio',
            ],
            [
            	'nombre'	=> 'Titulo Accesorio 03',
                'materia_prima'    => 'accesorio',
            ],
            [
                'nombre'    => 'Titulo Insumo 01',
                'materia_prima'    => 'insumo',
            ],
            [
                'nombre'    => 'Titulo Insumo 02',
                'materia_prima'    => 'insumo',
            ],
            [
                'nombre'    => 'Titulo Insumo 03',
                'materia_prima'    => 'insumo',
            ],
        ];

        DB::table('titulos')->insert($titulos);
    }
}
