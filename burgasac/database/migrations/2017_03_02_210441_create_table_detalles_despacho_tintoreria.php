<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallesDespachoTintoreria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('detalles_despacho_tintoreria', function(Blueprint $table) {
          $table->increments('id');

          $table->string('color');
          $table->integer('producto_id')->unsigned();
          $table->float('cantidad')->unsigned();

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
        Schema::drop('detalles_despacho_tintoreria');
    }
}
