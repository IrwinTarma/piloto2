<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planeamiento extends Model
{
  use SoftDeletes;


  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'planeamientos';

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
  protected $fillable = ['fecha', 'proveedor_id', 'empleado_id', 'maquina_id', 'producto_id','estado','turno','estado','rollos','kg_falla','kg_producidos','mp_producida','rollos_falla'];

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

  public function proveedor(){
      return $this->belongsTo('App\Proveedor');
  }

  public function detalles(){
    return $this->hasMany('App\DetallePlaneamiento');
  }


  public function producto(){
    return $this->belongsTo('App\Producto');

  }

  public function empleado(){
    return $this->belongsTo('App\Empleado');

  }

  public function maquina(){
    return $this->belongsTo('App\Maquina');

  }



}
