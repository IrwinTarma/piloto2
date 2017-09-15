<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDetallePlaneamientosDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_planeamientos', function(Blueprint $table) {
        $table->integer('accesorio_id')->default(0)->change();
        $table->integer('insumo_id')->default(0)->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('detalle_planeamientos', function (Blueprint $table) {
          //
      });
    }
}
