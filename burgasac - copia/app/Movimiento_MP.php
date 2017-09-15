<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_MP extends Model
{
    //
    protected $table = "movimiento_materiaprima";

    protected $fillable = ['fecha', 'compra_id', 'proveedor_id', 'lote', 'materiaprima_id', 'titulo_id', 'cantidad','estado','insumo_id','accesorio_id','descripcion','peso_neto'];



}
