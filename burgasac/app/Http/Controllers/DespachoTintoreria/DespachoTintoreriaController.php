<?php

namespace App\Http\Controllers\DespachoTintoreria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Producto;
use App\Proveedor;
use App\Color;
use App\DespachoTintoreria;
use App\Planeamiento;
use App\DetalleDespachoTintoreria;
use App\Movimiento_Tela;
use App\Resumen_Stock_Tela;
use App\ResumenDespachoTintoreria;
use App\ProveedorColorProducto;
use App\ProveedorDespachoTintoreriaDeuda;
use Session;
use DB;

use PDF;
use App;

class DespachoTintoreriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $despachoTintorerias = DespachoTintoreria::with("proveedor")->orderBy("id", "DESC")->get();

        foreach ($despachoTintorerias as $key => $value) {
            $despachoTintorerias[$key]->detalles = DetalleDespachoTintoreria::select("detalles_despacho_tintoreria.*",
              "c.nombre as color", "p.nombre_generico as producto")
            ->leftJoin("productos as p", "p.id", "=", "detalles_despacho_tintoreria.producto_id")
            ->leftJoin("color as c", "c.id", "=", "detalles_despacho_tintoreria.color_id")
            ->where('despacho_id', $value->id)->get();
        }

        return view('tintoreria.index',compact('despachoTintorerias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_id = \Config::get("sistema.tipo_proveedor_tintoreria_id");
        $productos = array();
        $proveedores = Proveedor::select("proveedores.id as proveedor_id", "nombre_comercial")
        ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
        ->where("pt.tipo_proveedor_id", "=", $tipo_id)
        ->get();
        $colores = Color::get();
        $planeamientos = DB::select(DB::raw("SELECT DISTINCT producto_id,proveedor_id FROM planeamientos"));

        foreach ($planeamientos as $key => $planeamiento) {
          $productos[] = Producto::find($planeamiento->producto_id);
        }

        return view('tintoreria.create',compact('productos','proveedores', 'colores'));
    }

    public function obtenerProveedores($producto_id){
      $tipo_id = \Config::get("sistema.tipo_proveedor_tintoreria_id");
      /*$planeamientos = Planeamiento::select("planeamientos.proveedor_id", "pr.nombre_comercial")
        ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "planeamientos.proveedor_id")
        ->leftJoin("proveedores as pr", "pr.id", "=", "planeamientos.proveedor_id")
        ->where("planeamientos.producto_id",$producto_id)
        //->where("pt.tipo_proveedor_id", "=", $tipo_id)
        ->get();
      /*$otrosproveedores = Proveedor::select("id", "nombre_comercial")
        ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
        ->where("pt.tipo_proveedor_id", "=", $tipo_id)
        ->get();*/
      $proveedores = Proveedor::select("proveedores.id as proveedor_id", "nombre_comercial")
        ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
        ->where("pt.tipo_proveedor_id", "=", $tipo_id)
        ->get();
        
      $resultado = [];
      $data = [];
      foreach ($proveedores as $key => $value) {
        $resultado[$value->proveedor_id] = $value;
      }
      /*foreach ($otrosproveedores as $key => $value) {
        $resultado[$value->proveedor_id] = $value;
      }*/
      foreach ($resultado as $key => $value) {
        $data[] = $value;
      }
      return $data;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $requestData = $request->all();
      //dd($requestData);
      /*
       * validate($request, $rules, $messages)
       */
      $this->validate($request, [
          'fecha'             => 'date',
          'detalles'          => 'required',
      ],
      [
          'detalles.required' => 'Ingrese al menos un detalle para el Despacho.'
      ]);

      $create  = ["proveedor_id" => $requestData["proveedor"]];
      $despacho_id = DespachoTintoreria::create($create)->id;

      if (isset($despacho_id)){
          foreach ($requestData['detalles'] as $detalle) {
            $detalle["proveedor_id"] = $detalle["proveedor"];
            $detalle["despacho_id"] = $despacho_id;
            $detalle["producto_id"] = $detalle["producto"];
            $detalle["cantidad"] = $detalle["kg"];
            $detalle["rollos"] = $detalle["rollos"];
            $detalle["nro_lote"] = $detalle["nro_lote"];


            $movimiento = array();
            $movimiento["planeacion_id"] = 0;
            $movimiento["proveedor_id"] = $detalle["proveedor_id"];
            $movimiento["producto_id"] = $detalle["producto_id"];
            $movimiento["rollos"] = - $detalle["rollos"];
            $movimiento["estado"] = 0;
            $movimiento["cantidad"] = - $detalle["kg"];
            $movimiento["descripcion"] = "Despacho a tintorerias";
            $movimiento["nro_lote"] = $detalle["nro_lote"];

            $movimiento_mp = Movimiento_Tela::create($movimiento);

            
            Resumen_Stock_Tela::calculateCurrentStock($detalle["producto_id"], 3,-($detalle["kg"]),-($detalle["rollos"]), $detalle["nro_lote"]);
            if (isset($detalle["color"])) {
              $detalle["color_id"] = $detalle["color"];

            }

            $iddetalledespacho = DetalleDespachoTintoreria::create($detalle);

            if (isset($detalle["color"])) {
              $detalle["color_id"] = $detalle["color"];

            } else {
              $detalle["color_id"] = 0;

            }
            unset($detalle["color"]);

            $resumen = ResumenDespachoTintoreria::where(["color_id" => $detalle["color_id"], "producto_id" => $detalle["producto"], "fecha" => $detalle["fecha"]])->whereRaw("deleted_at IS NULL")->first();

            //dd($resumen);
            if (!is_null($resumen)) {
              $objresumen = ResumenDespachoTintoreria::find($resumen->id);
            } else {
              $objresumen = new ResumenDespachoTintoreria;
              $objresumen->producto_id = $detalle["producto"];
              $objresumen->color_id = $detalle["color_id"];
              $objresumen->peso = 0;
              $objresumen->rollos = 0;
              $objresumen->fecha = $detalle["fecha"];
              $objresumen->save();
            }
            $objresumen->actualizar($detalle["cantidad"], $detalle["rollos"]);

            $proveedorcolorproducto = ProveedorColorProducto::where(["proveedor_id" => $detalle["proveedor_id"],
              "producto_id" => $detalle["producto_id"], "color_id" => $detalle["color_id"]])->whereRaw("deleted_at IS NULL")->orderBy("id", "DESC")->first();
            if (!is_null($proveedorcolorproducto)) {
              $objdeuda = new ProveedorDespachoTintoreriaDeuda;
              $objdeuda->proveedor_id = $detalle["proveedor_id"];
              $objdeuda->despacho_id = $detalle["despacho_id"];
              $objdeuda->color_id = $detalle["color_id"];
              $objdeuda->producto_id = $detalle["producto_id"];
              $objdeuda->preciounitario = $proveedorcolorproducto->precio;
              $objdeuda->total = $proveedorcolorproducto->precio*$detalle["kg"];
              $objdeuda->moneda_id = $proveedorcolorproducto->moneda_id;
              $objdeuda->detalle_despacho_id = $iddetalledespacho->id;
              $objdeuda->save();
            }
            
          }
      }

      Session::flash('flash_message', 'Datos guardados!');
      return redirect('despacho-tintoreria/despacho-tintoreria');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $despacho = DespachoTintoreria::find($id);
        $detalles = DetalleDespachoTintoreria::where("despacho_id",$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //$despacho = DespachoTintoreria::find($id);
        $detalles = DetalleDespachoTintoreria::where("despacho_id",$id)->get();
        foreach ($detalles as $key => $detalle) {
          $movimiento = array();
          $movimiento["planeacion_id"] = 0;
          $movimiento["proveedor_id"] = $detalle["proveedor_id"];
          $movimiento["producto_id"] = $detalle["producto_id"];
          $movimiento["rollos"] = $detalle["rollos"];
          $movimiento["estado"] = 0;
          $movimiento["cantidad"] = $detalle["cantidad"];
          $movimiento["descripcion"] = "Eliminacion de espacho a tintorerias";
          $movimiento["nro_lote"] = $detalle["nro_lote"];
          $movimiento_mp = Movimiento_Tela::create($movimiento);

          Resumen_Stock_Tela::calculateCurrentStock($detalle["producto_id"], $detalle["proveedor_id"],($detalle["cantidad"]),$detalle["rollos"], $detalle["nro_lote"]);
          $fecha = date("Y-m-d", strtotime($detalle["created_at"]));
         // dd($detalle);
         $resumen = ResumenDespachoTintoreria::where(["color_id" => $detalle["color_id"], "producto_id" => $detalle["producto_id"], "fecha" => $fecha])->whereRaw("deleted_at IS NULL")->first();
         //dd($resumen);

            if (!is_null($resumen)) {
              $objresumen = ResumenDespachoTintoreria::find($resumen->id);
              $objresumen->actualizar(-$detalle["cantidad"], -$detalle["rollos"]);
            }
            ProveedorDespachoTintoreriaDeuda::where(["proveedor_id" => $detalle["proveedor_id"], "producto_id" => $detalle["producto_id"], "despacho_id" => $id])->delete();

        }
        $despacho = DespachoTintoreria::find($id);
        DespachoTintoreria::find($id)->delete();


        Session::flash('flash_message', 'Datos guardados!');
        return redirect('despacho-tintoreria/despacho-tintoreria');


    }

    public function getBoleta(Request $request)
    {
      $pdf = App::make('dompdf.wrapper');
      $html = "";
      $despacho = DespachoTintoreria::find($request->id);
      $totalpeso = 0;
      $totalcantidad = 0;
      if (!is_null($despacho)) {
        $detalles = DetalleDespachoTintoreria::where(["despacho_id" => $despacho->id])
          ->with("color", "producto")->get();
        $proveedor = Proveedor::find($despacho->proveedor_id);
        $html.="<div style='font-family: Helvetica, font-size:11px'>";
        $html.="<p><b>Fecha: </b>".date('Y-m-d', strtotime($despacho->fecha))."</p>";
        $html.="<h1>Despacho de Tintorería - ".leadZero($despacho->id)."</h1>";
        $html.="<p><b>Proveedor: </b>".$proveedor->nombre_comercial."</p>";

        $html.="<div>";
              $html.="<table>";
                $html.="<thead>";
                  $html.="<tr>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 50px; padding:5px;'>Item</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 200px; padding:5px;'>Producto</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 100px; padding:5px;'>Color</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 120px; padding:5px;'>Rollos</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 80px; padding:5px;'>Peso</th>";
                  $html.="</tr>";
                $html.="</thead>";

                $html.="<tbody>";
                $i = 1;
                  foreach ($detalles as $key => $value) {
                    $html.="<tr>";
                    $html.="<td style='text-align:center; padding:5px;'>$i</td>";
                    //dd($value->insumo->nombre_generico);
                    if (!is_null($value->producto)) {
                      $html.="<td style='text-align:center; padding:5px;'>".$value->producto->nombre_generico."</td>";
                    }
                    if (!is_null($value->color)) {
                      $html.="<td style='text-align:center; padding:5px;'>".$value->color->nombre."</td>";
                    }
                    $html.="<td style='text-align:center; padding:5px;'>".$value->rollos."</td>";
                    $pesobruto = 0;
                    $pesotara = 0;
                    $totalcantidad+=$value->rollos;
                    $totalpeso+=$value->cantidad;
                    $html.="<td style='text-align:center; padding:5px;'>".number_format($value->cantidad, 2)."</td>";

                    $html.="</tr>";
                    $i++;
                  }
                $html.="<tr>";
                $html.="<td style='text-align:center; padding:5px;'></td>";
                $html.="<td style='text-align:center; padding:5px;'></td>";
                $html.="<td style='text-align:center; border: solid 1px; padding:5px;'><b>Total</b></td>";
                $html.="<td style='text-align:center; border: solid 1px; padding:5px;'><b>".number_format($totalcantidad, 2)."</b></td>";
                $html.="<td style='text-align:center; border: solid 1px; padding:5px;'><b>".number_format($totalpeso, 2)."</b></td>";
                $html.="</tr>";
                $html.="</tbody>";

              $html.="</table>";

          $html.="</div>";
        $html.="</div>";
      }


      $pdf->loadHTML($html)->setPaper('a4', 'landscape');
      return $pdf->stream();
    }

    public function getLotesConStock(Request $request)
    {
        $producto_id = $request->producto_id;
        $lotes = Resumen_Stock_Tela::where("producto_id", "=", $producto_id)
          ->where("proveedor_id", "=", 3)
          ->get();

        if (count($lotes) > 0) {
          return response(["rst" => 1,"lotes" => $lotes]);
        } else {
          return response(["rst" => 2,"msj" => "No existen lotes disponibles!!!"]);
        }
    }

    public function getStockporLote(Request $request)
    {
      $nro_lote = $request->nro_lote;
      $producto_id = $request->producto_id;
      $stock = Resumen_Stock_Tela::where("producto_id", "=", $producto_id)
          ->where("proveedor_id", "=", 3)
          ->where("nro_lote", "=", $nro_lote)
          ->first();

      if (!is_null($stock)) {
          return response(["rst" => 1,"stock" => $stock]);
        } else {
          return response(["rst" => 2,"msj" => "No existen lotes disponibles!!!"]);
        }
    }
}
