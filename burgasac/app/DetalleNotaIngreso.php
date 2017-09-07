<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleNotaIngreso extends Model
{
     /**
	   * The database table used by the model.
	   *
	   * @var string
	   */
	  protected $table = 'detalle_nota_ingreso';
	  public $timestamps = false;
	  /**
	  * The database primary key value.
	  *
	  * @var string
	  */
	  protected $primaryKey = 'dNotIng_id';

	  /**
	   * Attributes that should be mass-assignable.
	   *
	   * @var array
	   */
	  protected $fillable = ['nIng_id', 'tienda_id', 'cod_barras','peso_cant','rollo','impreso','fecha'];

}
