<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleDevolucionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_devoluciones', function(Blueprint $table) {
            $table->increments('id');
            $table->text('observaciones')->nullable();
            $table->integer('detalle_compra_id');

            $table->timestamp('fecha');
            $table->string('nro_lote');
            $table->string('marca');
            $table->string('titulo');
            $table->decimal('peso_bruto', 8, 2);
            $table->decimal('peso_tara', 8, 2);
            $table->string('cantidad_paquetes');
            
            $table->integer('insumo_id')->nullable();
            $table->integer('accesorio_id')->nullable();

            $table->integer('devolucion_id')->unsigned();
            $table->foreign('devolucion_id')->references('id')->on('devoluciones')->onDelete('cascade');

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
        Schema::drop('detalle_devoluciones');
    }
}
