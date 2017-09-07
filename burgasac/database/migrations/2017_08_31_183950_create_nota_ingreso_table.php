<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('nota_ingreso', function(Blueprint $table) {
          $table->increments('nIng_id')->unsigned();
          $table->int('despTint_id',10);
          $table->string('partida',20);
          //$table->timestamps('fecha');
          
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('nota_ingreso');
    }
}
