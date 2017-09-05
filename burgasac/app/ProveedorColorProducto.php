<?php

namespace App;

class ProveedorColorProducto extends BaseModel
{
    protected $table = 'proveedor_color_producto';
    protected $fillable=[
        'id',
        'proveedor_id',
        'producto_id',
        'color_id',
        'moneda_id',
        'precio',
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
}
