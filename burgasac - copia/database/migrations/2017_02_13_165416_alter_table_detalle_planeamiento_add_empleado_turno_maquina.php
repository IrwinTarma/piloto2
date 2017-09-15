<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDetallePlaneamientoAddEmpleadoTurnoMaquina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::table('detalle_planeamientos', function(Blueprint $table) {
        // $table->integer('empleado_id')->unsigned();
        // $table->foreign('empleado_id')->references('id')->on('empleados');
        // $table->string('turno');
        //
        // $table->integer('maquina_id')->unsigned();
        // $table->foreign('maquina_id')->references('id')->on('maquinas');
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
