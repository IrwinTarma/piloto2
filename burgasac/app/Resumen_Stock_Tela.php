<?php

namespace App;

class Resumen_Stock_Tela extends BaseModel
{
    //

    protected $table = "resumen_stock_telas";

    protected $fillable=[
        'id',
        'producto_id',
        'proveedor_id',
        'nro_lote',
        'cantidad',
        'rollos',
        'estado',
        'user_created_at',
        'user_updated_at',
        'user_deleted_at',
        'userid_created_at',
        'userid_updated_at',
        'userid_deleted_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function calculateCurrentStock($producto_id = 0,$proveedor_id = 0, $cant = 0,$rollos = 0, $nro_lote = ""){

      $resumen_stock_tela = (new static)->where("proveedor_id",$proveedor_id)
                                      ->where("producto_id",$producto_id)
                                      ->where("nro_lote", $nro_lote)
                                      ->orderBy("created_at","DESC")
                                      ->first();
      $resumen_tela = $resumen_stock_tela? $resumen_stock_tela: (new static);
      $resumen_tela->producto_id = $producto_id;
      $resumen_tela->proveedor_id = $proveedor_id;
      $resumen_tela->cantidad =  $resumen_stock_tela?  ($resumen_stock_tela->cantidad + $cant): $cant;
      $resumen_tela->rollos =  $resumen_stock_tela?  ($resumen_stock_tela->rollos + $rollos): $rollos;
      $resumen_tela->estado = 0;
      $resumen_tela->nro_lote = $nro_lote;
      if ($resumen_tela->cantidad==0) {
        
        $resumen_tela->delete();
      }
      else {
        # code...
        $resumen_tela->save();
      }
    }

    public function producto(){
      return $this->belongsTo('App\Producto');
    }

    public function proveedor(){
      return $this->belongsTo('App\Proveedor');
    }
}
