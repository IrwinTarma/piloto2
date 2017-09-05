<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accesorios';

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
    protected $fillable = ['nombre', 'titulo_id', 'proveedor_id'];

    /**
     * Get titulo associated with accesorio
     */
    public function titulo()
    {
        return $this->belongsTo('App\Titulo');
    }

    /**
     * Get proveedor associated with accesorio
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }
    
}
