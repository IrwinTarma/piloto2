<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResumenStockMateriaprima extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('resumen_stock_materiaprima', function(Blueprint $table) {
          $table->increments('id');
          $table->string('lote');
          $table->integer('materiaprima_id');
          $table->integer('proveedor_id');
          $table->integer('cantidad');
          $table->smallInteger('estado');
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
        Schema::drop('resumen_stock_materiaprima');
    }
}
