<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoriosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accesorios = [
            [
            	'nombre'	=> 'Accesorio 01',
                'titulo_id'    => 1,
            	'proveedor_id'		=> 1,
            ],
            [
            	'nombre'	=> 'Accesorio 02',
                'titulo_id'    => 1,
            	'proveedor_id'		=> 1,
            ],
            [
            	'nombre'	=> 'Accesorio 03',
                'titulo_id'    => 2,
            	'proveedor_id'		=> 2,
            ],
            [
            	'nombre'	=> 'Accesorio 04',
                'titulo_id'    => 2,
            	'proveedor_id'		=> 2,
            ],
            [
            	'nombre'	=> 'Accesorio 05',
                'titulo_id'    => 3,
            	'proveedor_id'		=> 2,
            ],
        ];

        DB::table('accesorios')->insert($accesorios);
    }
}
