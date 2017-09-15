<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDetallePlaneamientoRemoveFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_planeamientos', function(Blueprint $table) {
        $table->dropColumn('maquina_id');
        $table->dropColumn('empleado_id');
        $table->dropForeign('detalle_planeamientos_insumo_id_foreign');
        $table->dropColumn('insumo_id');

        $table->dropColumn('lote_accesorio');
        $table->dropColumn('cantidad');

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
