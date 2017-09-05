<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            [
            	'nombre_generico'	=> 'Tela 01',
            ],
            [
            	'nombre_generico'	=> 'Tela 02',
            ],
            [
            	'nombre_generico'	=> 'Tela 03',
            ],
            [
            	'nombre_generico'	=> 'Tela 04',
            ],
            [
            	'nombre_generico'	=> 'Tela 05',
            ],
        ];

        DB::table('productos')->insert($productos);
    }
}
