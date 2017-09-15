<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'detalle_compras';

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
    protected $fillable = ['nro_lote', 'titulo_id', 'peso_bruto', 'peso_tara', 'cantidad', 'observaciones', 'insumo_id', 'accesorio_id', 'compra_id'];

    public function insumo()
    {
        return $this->belongsTo('App\Insumo');
    }

    public function accesorio()
    {
        return $this->belongsTo('App\Accesorio');
    }


    public function titulo(){
        return $this->belongsTo('App\Titulo');
    }

    public function resumen(){
      return $this->hasMany("App\Resumen_Stock_MP");
    }

}
