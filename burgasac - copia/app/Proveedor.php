<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proveedores';

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
        'nombre_comercial',
        'razon_social',
        'ruc',
        'direccion',
        'direccion_secundaria',
        'email',
        'telefono',
        'ciudad',
        'observaciones',
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

    /**
     * Get insumos associated with proveedor
     */
    public function insumos()
    {
        return $this->hasMany('App\Insumo');
    }

    /**
     * Get accesorios associated with proveedor
     */
    public function accesorios()
    {
        return $this->hasMany('App\Accesorio');
    }

    /**
     * Get compras associated with proveedor
     */
    public function compras()
    {
        return $this->hasMany('App\Compra');
    }

    public function proveedortipo()
    {
        return $this->hasMany('App\ProveedorTipo');
    }
}
