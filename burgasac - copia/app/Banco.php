<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bancos';

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
     * Get cronogramas associated to banco
     */
    public function cronogramas()
    {
        return $this->hasMany('App\Cronograma');
    }
}
