<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_abonos', function(Blueprint $table) {
            $table->increments('id');
            $table->decimal('monto', 8, 2);
            $table->text('observaciones')->nullable();

            $table->timestamp('fecha');
            $table->decimal('peso_bruto', 8, 2);
            $table->decimal('peso_tara', 8, 2);
            $table->string('cantidad_paquetes');

            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->integer('abono_id')->unsigned();
            $table->foreign('abono_id')->references('id')->on('abonos')->onDelete('cascade');

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
        Schema::drop('detalle_abonos');
    }
}
