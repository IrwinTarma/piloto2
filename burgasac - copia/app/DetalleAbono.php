<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAbono extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalle_abonos';

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
    protected $fillable = ['observaciones', 'monto', 'fecha', 'peso_bruto', 'peso_tara', 'cantidad_paquetes', 'producto_id', 'abono_id'];

    
}
