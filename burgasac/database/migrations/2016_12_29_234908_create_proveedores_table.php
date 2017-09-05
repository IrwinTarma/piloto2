<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_comercial');
            $table->string('razon_social')->nullable();
            $table->string('ruc')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('ciudad')->nullable();
            $table->text('observaciones')->nullable();
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
        Schema::drop('proveedores');
    }
}
