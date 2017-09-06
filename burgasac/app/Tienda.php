<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tienda';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'tienda_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['desc_tienda'];

}
