<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = [
            [
            	'nombre'	=> 'Local 01',
            ],
            [
            	'nombre'	=> 'Local 02',
            ],
            [
            	'nombre'	=> 'Local 03',
            ],
            [
            	'nombre'	=> 'Local 04',
            ],
            [
            	'nombre'	=> 'Local 05',
            ],
        ];

        DB::table('locales')->insert($locales);
    }
}
