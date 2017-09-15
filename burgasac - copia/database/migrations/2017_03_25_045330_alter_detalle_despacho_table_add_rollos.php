<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDetalleDespachoTableAddRollos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalles_despacho_tintoreria', function(Blueprint $table) {
          $table->float('rollos');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('detalles_despacho_tintoreria', function (Blueprint $table) {
          //
      });
    }
}
