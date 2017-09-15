<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDetallePlaneamientoRemoveData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('detalle_planeamientos', function(Blueprint $table) {
        $table->dropColumn('rollos');
        $table->dropColumn('kg_producidos');
        $table->dropColumn('kg_falla');
        $table->dropColumn('agujas');
      });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
