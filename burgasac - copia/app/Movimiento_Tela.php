<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_Tela extends Model
{
    //

    protected $table = "movimiento_tela";

    protected $fillable = ['planeacion_id', 'producto_id','cantidad','estado','proveedor_id','rollos','descripcion', 'nro_lote'];

}
