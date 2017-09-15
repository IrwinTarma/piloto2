<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronogramas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cuotas')->nullable();
            $table->boolean('tipo_de_pago');
            $table->timestamp('fecha');
            $table->decimal('monto', 10, 2);
            $table->text('observaciones')->nullable();

            $table->integer('banco_id')->unsigned()->nullable();
            $table->foreign('banco_id')->references('id')->on('bancos')->onDelete('cascade');

            $table->integer('tipopago_id')->unsigned()->nullable();
            $table->foreign('tipopago_id')->references('id')->on('tipos_pagos')->onDelete('cascade');

            $table->integer('compra_id')->unsigned();
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');

            $table->integer('created_by');
            $table->integer('updated_by');
            
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
        Schema::drop('cronogramas');
    }
}
