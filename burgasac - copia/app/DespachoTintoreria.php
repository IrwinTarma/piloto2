<?php

namespace App;

class DespachoTintoreria extends BaseModel
{
    //

    protected $table = "despacho_tintoreria";
    protected $primaryKey = 'id';

        protected $fillable=[
        'id',
        'proveedor_id',
        'fecha',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_created_at',
        'user_updated_at',
        'user_deleted_at',
        'userid_created_at',
        'userid_updated_at',
        'userid_deleted_at'       
    ];

    public function detalledespachotintoreria(){
        return $this->hasMany('App\DetalleDespachoTintoreria');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
}
