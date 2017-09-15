<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDetalleDespachoTerceros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalles_despacho_terceros', function(Blueprint $table) {
          $table->float('rollos')->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


    }
}
