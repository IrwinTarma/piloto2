<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveedores = [
            [
            	'nombre_comercial'	=> 'Proveedor 01',
            ],
            [
            	'nombre_comercial'	=> 'Proveedor 02',
            ],
            [
            	'nombre_comercial'	=> 'Proveedor 03',
            ],
            [
            	'nombre_comercial'	=> 'Proveedor 04',
            ],
            [
            	'nombre_comercial'	=> 'Proveedor 05',
            ],
        ];

        DB::table('proveedores')->insert($proveedores);
    }
}
