<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecepcionMp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recepcion_mp', function(Blueprint $table) {
          $table->increments('id');
          $table->timestamp('fecha');
          $table->integer('codigo')->nullable();
          $table->string('nro_guia');
          $table->text('observaciones')->nullable();

          $table->integer('proveedor_id')->unsigned();
          $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');


          $table->integer('created_by');
          $table->integer('updated_by');

          $table->timestamps();
          $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recepcion_mp');
    }
}
