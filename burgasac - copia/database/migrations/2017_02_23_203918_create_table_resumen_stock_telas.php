<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResumenStockTelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('resumen_stock_telas', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('producto_id');
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
        Schema::drop('resumen_stock_telas');
    }
}
