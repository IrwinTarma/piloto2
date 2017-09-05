<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->integer('codigo')->nullable();
            $table->string('nro_comprobante')->nullable();
            $table->string('nro_guia')->nullable();
            $table->text('observaciones')->nullable();

            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');

            $table->integer('procedencia_id')->unsigned();
            $table->foreign('procedencia_id')->references('id')->on('procedencias')->onDelete('cascade');

            $table->integer('estado')->unsigned();
            $table->foreign('estado')->references('id')->on('compra_estados')->onDelete('cascade');
            
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
        Schema::drop('compras');
    }
}
