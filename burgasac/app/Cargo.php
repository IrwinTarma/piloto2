<?php

namespace App;

class Cargo extends BaseModel
{    
    protected $table = 'cargo';
    protected $fillable=[
        'id',
        'nombre',
        'descripcion',
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
