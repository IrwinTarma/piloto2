<?php

namespace App;

class ProveedorDespachoTintoreriaDeuda extends BaseModel
{
    protected $table = 'proveedor_despacho_tintoreria_deuda';
    protected $fillable=[
        'id',
        'proveedor_id',
        'producto_id',
        'color_id',
        'despacho_id',
        'detalle_despacho_id',
        'moneda_id',
        'preciounitario',
        'total',
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

    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
    public function despacho()
    {
        return $this->belongsTo('App\DespachoTintoreria');
    }
}
