<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsumosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insumos = [
            [
            	'nombre_generico'	=> 'Insumo 01',
            	'titulo_id'     => 1,
                'proveedor_id'		=> 1,
                'descripcion' => 'Descripcion 1'
            ],
            [
            	'nombre_generico'	=> 'Insumo 02',
                'titulo_id'     => 1,
            	'proveedor_id'		=> 1,
                'descripcion' => 'Descripcion 2'
            ],
            [
            	'nombre_generico'	=> 'Insumo 03',
                'titulo_id'     => 2,
            	'proveedor_id'		=> 2,
                'descripcion' => 'Descripcion 3'
            ],
            [
            	'nombre_generico'	=> 'Insumo 04',
                'titulo_id'     => 2,
            	'proveedor_id'		=> 2,
                'descripcion' => 'Descripcion 4'
            ],
            [
            	'nombre_generico'	=> 'Insumo 05',
                'titulo_id'     => 3,
            	'proveedor_id'		=> 2,
                'descripcion' => 'Descripcion 5'
            ],
        ];

        DB::table('insumos')->insert($insumos);
    }
}
