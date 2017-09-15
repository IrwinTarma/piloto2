<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDespachoTintoreria extends Model
{
    protected $table = "detalles_despacho_tintoreria";

    protected $fillable = [
    "color_id",
    "producto_id",
    'nro_lote',
    "cantidad",
    "proveedor_id",
    "despacho_id",
    //"descripcion",    
    "rollos",
    "estado",
    "created_at",
    "update_at"
    ];

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }
    //
    public function proveedor(){
        return $this->belongsTo('App\Proveedor');
    }
    public function despachotintoreria(){
        return $this->belongsTo('App\DespachoTintoreria', 'id', 'id');
    }

   }
