<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nro_lote')->nullable();
            $table->decimal('peso_bruto', 8, 2)->nullable();
            $table->decimal('peso_tara', 8, 2)->nullable();
            $table->decimal('cantidad', 8, 2)->nullable();
            $table->text('observaciones')->nullable();

            $table->integer('titulo_id')->unsigned();
            $table->foreign('titulo_id')->references('id')->on('titulos')->onDelete('cascade');

            $table->integer('insumo_id')->unsigned()->nullable();
            $table->foreign('insumo_id')->references('id')->on('insumos')->onDelete('cascade');

            $table->integer('accesorio_id')->unsigned()->nullable();
            $table->foreign('accesorio_id')->references('id')->on('accesorios')->onDelete('cascade');

            $table->integer('compra_id')->unsigned();
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            
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
        Schema::drop('detalle_compras');
    }
}
