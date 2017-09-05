<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_generico');
            $table->string('nombre_especifico')->nullable();
            $table->string('material')->nullable();

            $table->integer('titulo_id')->unsigned();
            $table->foreign('titulo_id')->references('id')->on('titulos');

            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');

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
        Schema::drop('insumos');
    }
}
