<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaIngresoAsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('nota_ingreso_a', function(Blueprint $table) {
          $table->increments('nIngA_id')->unsigned();
          $table->int('proveedor_id',10)->unsigned();
          $table->int('producto_id',10)->unsigned();
          $table->int('color_id',10)->unsigned();
          $table->string('partida',20);
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
      Schema::drop('nota_ingreso_a');
    }
}
