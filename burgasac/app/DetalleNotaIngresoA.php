<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNotaIngresoA extends Model
{
     /**
	   * The database table used by the model.
	   *
	   * @var string
	   */
	  protected $table = 'detalle_nota_ingreso_a';
	  public $timestamps = false;
	  /**
	  * The database primary key value.
	  *
	  * @var string
	  */
	  protected $primaryKey = 'dNotInga_id';

	  /**
	   * Attributes that should be mass-assignable.
	   *
	   * @var array
	   */
	  protected $fillable = ['ninga_id', 'tienda_id', 'cod_barras','peso_cant','rollo','impreso','estado','fecha'];
}
