<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleNotaIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalle_nota_ingreso', function(Blueprint $table) {
          $table->increments('dNotIng_id')->unsigned();
          $table->int('nIng_id',10)->unsigned();
          $table->int('tienda_id',10)->unsigned();
          $table->string('cod_barras',20);
          $table->float('peso_cant',8,2);
          $table->int('rollo',10);
          $table->boolean('impreso');
          $table->timestamps('fecha');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('detalle_nota_ingreso');
    }
}
