<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProveedorTipo extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'proveedor_tipo';

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
    protected $fillable = ['id', 'proveedor_id', 'tipo_proveedor_id'];

    
}
