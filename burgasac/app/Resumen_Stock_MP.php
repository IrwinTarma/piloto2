<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resumen_Stock_MP extends Model
{
    //

    protected $table = "resumen_stock_materiaprima";

    public static function updateCurrentStockForLote($lote = "",$cant=0){

      $resumen_stock_mp = (new static)->where("lote",$lote)
                                      ->orderBy("created_at","DESC")
                                      ->first();

      $resumen_stock_mp->cantidad = $cant;
      $resumen_stock_mp->save();

    }
    public static function calculateCurrentStock($lote = "",$insumo = 0,$accesorio = 0, $proveedor = "",$peso = 0,$cant = 0, $titulo = 0){
      if($accesorio!=0){
        $resumen_stock_mp = (new static)->where("accesorio_id",$accesorio)
                                        ->where("titulo_id", $titulo)
                                              ->orderBy("created_at","DESC")
                                              ->first();
      }else {
        $resumen_stock_mp = (new static)->where("lote",$lote)
                                        ->where("titulo_id", $titulo)
                                              ->orderBy("created_at","DESC")
                                              ->first();
      }


      $resumen_mp = !$resumen_stock_mp?  (new static) : $resumen_stock_mp;
      $resumen_mp->insumo_id = $insumo;
      $resumen_mp->accesorio_id = $accesorio;
      $resumen_mp->proveedor_id = $proveedor;
      $resumen_mp->lote = $lote;
      $resumen_mp->cantidad = $resumen_stock_mp? ($resumen_stock_mp->cantidad + $cant) : $cant;
      $resumen_mp->peso_neto =  $resumen_stock_mp?  ($resumen_stock_mp->peso_neto + $peso): $peso;
      $resumen_mp->titulo_id = $titulo;
      $resumen_mp->estado = 1;
      if ($resumen_mp->cantidad==0) {
        $resumen_mp->delete();
      }
      else {
        # code...
        $resumen_mp->save();
      }
      // dd($resumen_mp);
    }


    public function insumo(){
      return $this->belongsTo('App\Insumo');
    }


    public function accesorio(){
      return $this->belongsTo('App\Accesorio');
    }

    public function titulo(){
      return $this->belongsTo('App\Titulo');
    }

    public function proveedor(){
      return $this->belongsTo('App\Proveedor');
    }
}
