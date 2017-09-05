<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAbonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonos', function(Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->text('observaciones')->nullable();
            
            $table->integer('tipoabono_id')->unsigned();
            $table->foreign('tipoabono_id')->references('id')->on('tipos_abonos')->onDelete('cascade');

            $table->integer('compra_id')->unsigned();
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');

            $table->integer('created_by');
            $table->integer('updated_by');

            $table->softDeletes();
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
        Schema::drop('abonos');
    }
}
