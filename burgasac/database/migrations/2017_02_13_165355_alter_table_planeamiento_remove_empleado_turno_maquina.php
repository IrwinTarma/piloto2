<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePlaneamientoRemoveEmpleadoTurnoMaquina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('planeamientos', function(Blueprint $table) {
        $table->dropForeign('planeamientos_empleado_id_foreign');
        $table->dropColumn('empleado_id');

        $table->dropColumn('turno');
        $table->dropForeign('planeamientos_maquina_id_foreign');
        $table->dropColumn('maquina_id');

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
