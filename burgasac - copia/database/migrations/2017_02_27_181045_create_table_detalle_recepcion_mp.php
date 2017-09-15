<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetalleRecepcionMp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('recepcion_mp_detalles', function(Blueprint $table) {

        $table->increments('id');
        $table->timestamp('fecha');
        $table->string('nro_lote');
        $table->string('marca');
        $table->string('titulo');
        $table->decimal('peso_bruto', 8, 2);
        $table->decimal('peso_tara', 8, 2);
        $table->string('cantidad_paquetes');
        $table->text('observaciones')->nullable();

        $table->integer('insumo_id')->unsigned()->nullable();
        $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete('cascade');

        $table->integer('accesorio_id')->unsigned()->nullable();
        $table->foreign('accesorio_id')->references('id')->on('accesorios')->onDelete('cascade');

        $table->integer('recepcion_id')->unsigned();
        $table->foreign('recepcion_id')->references('id')->on('recepcion_mp')->onDelete('cascade');

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
        Schema::drop('recepcion_mp_detalles');
    }
}
