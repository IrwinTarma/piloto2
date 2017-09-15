<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = "indicador";

    protected $fillable = ['producto_id','insumo_id','valor', 'titulo_id'];


    public function insumo(){
      return $this->belongsTo("App\Insumo");
    }

    public function titulo(){
    	return $this->belongsTo("App\Titulo");
    }

}
