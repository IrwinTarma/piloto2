<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallesDespachoTerceros extends Model
{
  	protected $table = "detalles_despacho_terceros";

  	protected $fillable = ["color_id","producto_id","cantidad","proveedor_id","descripcion",'despacho_id','rollos'];


    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }

}
