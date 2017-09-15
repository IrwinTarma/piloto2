<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlaneamientosTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('planeamientos', function(Blueprint $table) {
        $table->integer('empleado_id');
        $table->string('turno');
        $table->integer('maquina_id');
        $table->integer('insumo_id');
        $table->integer('lote_accesorio');
        $table->integer('cantidad');
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
