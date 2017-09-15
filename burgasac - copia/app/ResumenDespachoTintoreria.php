<?php

namespace App;

class ResumenDespachoTintoreria extends BaseModel
{
    //

    protected $table = "resumen_despacho_tintoreria";

    protected $fillable=[
        'id',
        'color_id',
        'producto_id',
        'proveedor_id',
        'peso',
        'rollos',
        'fecha',
        'estado',
        'user_created_at',
        'user_updated_at',
        'user_deleted_at',
        'userid_created_at',
        'userid_updated_at',
        'userid_deleted_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function actualizar($cantidad = 0, $rollos = 0)
    {
        $this->peso+=$cantidad;
        $this->rollos+=$rollos;
        $this->save();
    }

        public function producto(){
      return $this->belongsTo('App\Producto');
    }

    public function proveedor(){
      return $this->belongsTo('App\Proveedor');
    }

        public function color(){
      return $this->belongsTo('App\Color');
    }


}