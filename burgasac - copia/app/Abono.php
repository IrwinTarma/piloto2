<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\UpdaterTrait;

class Abono extends Model
{
    use UpdaterTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'abonos';

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
    protected $fillable = ['fecha', 'observaciones', 'tipoabono_id', 'compra_id'];

    /**
     * Get compra associated with abono
     */
    public function compra()
    {
        return $this->belongsTo('App\Compra');
    }

    /**
     * Get producto associated with abono
     */
    public function producto()
    {
        return $this->belongsTo('App\Producto');
    }
}
