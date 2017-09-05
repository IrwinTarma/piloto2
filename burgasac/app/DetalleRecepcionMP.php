<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleRecepcionMP extends Model
{
  protected $table = "recepcion_mp_detalles";

  protected $fillable = ["fecha","nro_lote","titulo","peso_bruto","peso_tara","cantidad_paquetes","insumo_id","accesorio_id","recepcion_id"];

  public function insumo()
  {
      return $this->belongsTo('App\Insumo');
  }

  /**
   * Get accesorio associated with detallecompra
   */
  public function accesorio()
  {
      return $this->belongsTo('App\Accesorio');
  }

  public function titulo(){
      return $this->belongsTo('App\Titulo','titulo');
  }

  public function resumen(){
    return $this->hasMany("App\Resumen_Stock_MP");
  }

}
