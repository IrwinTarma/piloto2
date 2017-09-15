<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\UpdaterTrait;

class Compra extends Model
{
    use SoftDeletes;

    use UpdaterTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'compras';

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
    protected $fillable = ['fecha', 'codigo', 'tipo_comprobante', 'nro_comprobante', 'nro_guia', 'estado', 'observaciones', 'proveedor_id', 'procedencia_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get cronograma associated with compra
     */
    public function cronograma()
    {
        return $this->hasOne('App\Cronograma');
    }

    /**
     * Get proveedor associated with compra
     */
    public function proveedor()
    {
        return $this->belongsTo('App\Proveedor');
    }

    /**
     * Get compra_estado associated with compra
     */
    public function estado()
    {
        return $this->hasOne('App\CompraEstado');
    }

    public function detalles(){
        return $this->hasMany('App\DetalleCompra');
    }

    public function procedencia(){
      return $this->belongsTo('App\Procedencia');
    }

}
