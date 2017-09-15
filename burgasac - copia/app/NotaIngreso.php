<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaIngreso extends Model
{
    /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'nota_ingreso';
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
  protected $fillable = ['despTint_id', 'partida'];

}
