<?php

namespace App;

class Insumo extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'insumos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_generico',
        'nombre_especifico',
        'material',
        'titulo_id',
        'descripcion',
        'user_created_at',
        'user_updated_at',
        'user_deleted_at',
        'userid_created_at',
        'userid_updated_at',
        'userid_deleted_at',
        'created_at',
        'updated_at',
        'deleted_at' ];

    /**
     * Get titulo associated with insumo
     */
    public function titulo()
    {
        return $this->belongsTo('App\Titulo');
    }

    /**
     * Get proveedor associated with insumo
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    public function detallesplaneamiento(){
      return $this->hasMany('App\DetallePlaneamiento');
    }
}
