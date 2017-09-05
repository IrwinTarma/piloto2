<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipospago = [
            [
            	'nombre'		=> 'Credito',
            ],
            [
                'nombre'        => 'Contado',
            ],
        ];

        DB::table('tipos_pagos')->insert($tipospago);
    }
}
