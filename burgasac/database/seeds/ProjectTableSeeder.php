<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessTableSeeder
 */
class ProjectTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
    {
        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(AccesoriosTableSeeder::class);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(InsumosTableSeeder::class);
        $this->call(LocalesTableSeeder::class);
        $this->call(MaquinasTableSeeder::class);
        $this->call(ProveedoresTableSeeder::class);
        $this->call(TitulosTableSeeder::class);
        $this->call(ProcedenciasTableSeeder::class);
        $this->call(BancosTableSeeder::class);
        $this->call(TiposPagoTableSeeder::class);
        $this->call(TiposAbonoTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(CompraEstadosTableSeeder::class);

        if (DB::connection()->getDriverName() == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}