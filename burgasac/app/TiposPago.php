<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposPago extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tipos_pagos';

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
    protected $fillable = ['nombre'];

    /**
     * Get cronogramas associated to tipopago
     */
    public function cronogramas()
    {
        return $this->hasMany('App\Cronograma');
    }    
}
