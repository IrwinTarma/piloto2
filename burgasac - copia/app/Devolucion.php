<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\UpdaterTrait;

class Devolucion extends Model
{
    use SoftDeletes;

    use UpdaterTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devoluciones';

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
    protected $fillable = ['fecha', 'tipo_devolucion', 'observaciones', 'compra_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get compra associated with devolucion
     */
    public function compra()
    {
        return $this->belongsTo('App\Compra');
    }
    
}
