<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\UpdaterTrait;

class Cronograma extends Model
{
    use UpdaterTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cronogramas';

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
    protected $fillable = ['cuotas', 'monto', 'fecha', 'banco_id', 'tipopago_id', 'compra_id', 'tipo_de_pago', 'observaciones'];

    /**
     * Attributes that be used as dates
     *
     * @var array
     */
    //protected $dates = ['fecha'];
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Laravel Mutator
     */
    /*public function setFechaAttribute($fecha)
    {
        $this->attributes['fecha'] = Carbon::parse($fecha);
    }*/

    /**
     * Get banco associated with cronograma
     */
    public function banco()
    {
        return $this->belongsTo('App\Banco');
    }

    /**
     * Get tipo_pago associated with cronograma
     */
    public function tipopago()
    {
        return $this->belongsTo('App\TiposPago');
    }

    /**
     * Get compra associated with cronograma
     */
    public function compra()
    {
        return $this->belongsTo('App\Compra');
    }
}
