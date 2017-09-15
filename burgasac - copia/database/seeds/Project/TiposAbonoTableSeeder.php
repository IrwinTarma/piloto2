<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposAbonoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposabono = [
            [
            	'nombre'		=> 'Concepto Abono 01',
            ],
            [
                'nombre'        => 'Concepto Abono 02',
            ],
            [
                'nombre'        => 'Concepto Abono 03',
            ],
            [
                'nombre'        => 'Concepto Abono 04',
            ],
        ];

        DB::table('tipos_abonos')->insert($tiposabono);
    }
}
