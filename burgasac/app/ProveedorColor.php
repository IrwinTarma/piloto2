<?php

namespace App;

class ProveedorColor extends BaseModel
{
    protected $table = 'proveedor_color';
    protected $fillable=[
        'id',
        'proveedor_id',
        'color_id',
        'codigo',
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
}
