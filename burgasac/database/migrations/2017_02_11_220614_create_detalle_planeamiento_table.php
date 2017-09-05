<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePlaneamientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalle_planeamientos', function(Blueprint $table) {
          $table->increments('id');
          $table->date('fecha');

          $table->string('lote_accesorio');

          $table->integer('planeamiento_id')->unsigned();
          $table->foreign('planeamiento_id')->references('id')->on('planeamientos');

          $table->integer('accesorio_id')->unsigned();
          $table->foreign('accesorio_id')->references('id')->on('accesorios');

          $table->integer('cantidad')->unsigned();

          $table->integer('insumo_id')->unsigned();
          $table->foreign('insumo_id')->references('id')->on('insumos');

          $table->integer('titulo_id')->unsigned();
          $table->foreign('titulo_id')->references('id')->on('titulos');

          $table->string('lote_insumo');


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
        Schema::drop('detalle_planeamientos');
    }
}
