<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\UpdaterTrait;

class Recepcion_MP extends Model
{

  use SoftDeletes;

  use UpdaterTrait;


  protected $table = "recepcion_mp";

  protected $fillable = ["fecha","codigo","nro_guia","observaciones","proveedor_id"];

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
      return $this->hasMany('App\DetalleRecepcionMP');
  }
}
