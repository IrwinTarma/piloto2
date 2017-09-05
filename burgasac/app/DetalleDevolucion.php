<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalle_devoluciones';

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
    protected $fillable = ['observaciones', 'detalle_compra_id', 'devolucion_id', 'fecha', 'nro_lote', 'marca', 'titulo', 'peso_bruto', 'peso_tara', 'cantidad_paquetes', 'insumo_id', 'accesorio_id'];

    
}
