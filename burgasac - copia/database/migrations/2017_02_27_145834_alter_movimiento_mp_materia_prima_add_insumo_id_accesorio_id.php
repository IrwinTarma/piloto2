<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMovimientoMpMateriaPrimaAddInsumoIdAccesorioId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('movimiento_materiaprima', function(Blueprint $table) {
        $table->integer('insumo_id');
        $table->integer('accesorio_id');
        $table->dropColumn('materiaprima_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
