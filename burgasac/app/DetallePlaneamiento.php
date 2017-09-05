<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePlaneamiento extends Model
{
    //
    protected $table = "detalle_planeamientos";

    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'planeamiento_id','insumo_id','titulo_id','cantidad','lote_insumo','cajas','Kg','mp_producida','accesorio_id','lote_accesorio'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];



    public function insumo(){
      return $this->belongsTo('App\Insumo');
    }

    public function titulo(){
      return $this->belongsTo('App\Titulo');
    }

    public function accesorio(){
      return $this->belongsTo('App\Accesorio');
    }

}
