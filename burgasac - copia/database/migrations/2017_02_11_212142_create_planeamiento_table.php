<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaneamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('planeamientos', function(Blueprint $table) {
          $table->increments('id');
          $table->date('fecha');

          $table->integer('proveedor_id')->unsigned();
          $table->foreign('proveedor_id')->references('id')->on('proveedores');

          $table->integer('empleado_id')->unsigned();
          $table->foreign('empleado_id')->references('id')->on('empleados');

          $table->integer('maquina_id')->unsigned();
          $table->foreign('maquina_id')->references('id')->on('maquinas');

          $table->integer('producto_id')->unsigned();
          $table->foreign('producto_id')->references('id')->on('productos');

          $table->softDeletes();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('planeamientos');
    }
}
