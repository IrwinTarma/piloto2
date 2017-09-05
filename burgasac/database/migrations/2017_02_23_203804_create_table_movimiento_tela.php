<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMovimientoTela extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('movimiento_tela', function(Blueprint $table) {
          $table->increments('id');
          $table->integer('planeacion_id');
          $table->integer('producto_id');
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
        Schema::drop('movimiento_tela');
    }
}
