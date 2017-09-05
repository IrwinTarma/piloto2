<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraEstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $compra_estados = [
            [
            	'nombre'	=> 'Transición',
            ],
            [
            	'nombre'	=> 'Recepcionado',
            ],
        ];

        DB::table('compra_estados')->insert($compra_estados);
    }
}