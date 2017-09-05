<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BancosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bancos = [
            [
            	'nombre'		=> 'Banco de Credito',
            ],
            [
                'nombre'        => 'Interbank',
            ],
            [
                'nombre'        => 'Scotiabank',
            ],
            [
                'nombre'        => 'Banco de la Nacion',
            ],
            [
                'nombre'        => 'BBVA Banco Continental',
            ],
        ];

        DB::table('bancos')->insert($bancos);
    }
}
