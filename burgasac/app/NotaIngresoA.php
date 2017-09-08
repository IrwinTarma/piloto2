<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaIngresoA extends Model
{
     /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'nota_ingreso_a';
  public $timestamps = false;

  /**
  * The database primary key value.
  *
  * @var string
  */
  protected $primaryKey = 'nIng_id';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['ninga_id','color_id', 'producto_id','proveedor_id','partida','fecha'];
}
