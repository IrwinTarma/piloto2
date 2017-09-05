<?php

namespace App\Http\Controllers\DespachoTerceros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DespachoTerceros;
use App\Producto;
use App\Proveedor;
use App\Color;
use App\Planeamiento;
use App\Movimiento_Tela;
use App\Resumen_Stock_Tela;
use App\DetallesDespachoTerceros;
use DB;
use Session;
use App;

class DespachoTercerosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $despachos = DespachoTerceros::all();
        foreach ($despachos as $key => $despacho) {
            $despacho->detalles = DetallesDespachoTerceros::where('despacho_id', $despacho->id)
            ->with("color", "producto")->get();
        }
        return view('despacho-terceros.index',compact('despachos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tipo_id = \Config::get("sistema.tipo_proveedor_despacho_tercero_id");
      $planeamientos = DB::select(DB::raw("SELECT DISTINCT producto_id,proveedor_id FROM planeamientos"));
      $datacolores = Color::where(["estado" => 1])->get();
      $productos = [];
      $colores = [];
        foreach ($planeamientos as $key => $planeamiento) {
          $productos[] = Producto::find($planeamiento->producto_id);
        }
      foreach ($datacolores as $key => $value) {
        $colores[$value->id] = $value->nombre;
      }
      //dd($productos);
      $proveedores = Proveedor::select("proveedores.*")
          ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
          ->where("pt.tipo_proveedor_id", "=", $tipo_id)
          ->get();

        return view('despacho-terceros.create',compact('productos','proveedores', 'colores'));
    }


    public function obtenerProductos($proveedor_id){
      $planeamientos = Planeamiento::where("proveedor_id",$proveedor_id)
                                    ->where("estado",1)
                                    ->with('producto')->get();
      return $planeamientos;

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
      if (isset($requestData["proveedor"])) {
        $requestData["proveedor_id"] = $requestData["proveedor"];
        unset($requestData["proveedor"]);
      }
      /*
       * validate($request, $rules, $messages)
       */
      $this->validate($request, [
          'fecha'             => 'date',
          'detalles'          => 'required',
      ],
      [
          'detalles.required' => 'Ingrese al menos un detalle a la compra.'
      ]);


      $despacho_id = DespachoTerceros::create($requestData)->id;

      if (isset($despacho_id)){
          foreach ($requestData['detalles'] as $detalle) {
            $detalle["proveedor_id"] = $detalle["proveedor"];
            $detalle["despacho_id"] = $despacho_id;
            $detalle["producto_id"] = $detalle["producto"];
            $detalle["cantidad"] = $detalle["kg"];
            $detalle["rollos"] = $detalle["rollos"];
            if (isset($detalle["color"])) {
              $detalle["color_id"] = $detalle["color"];
              unset($detalle["color"]);
            }

            $movimiento = array();
            $movimiento["planeacion_id"] = 0;
            $movimiento["proveedor_id"] = $detalle["proveedor_id"];
            $movimiento["producto_id"] = $detalle["producto_id"];
            $movimiento["rollos"] = - $detalle["rollos"];
            $movimiento["estado"] = 0;
            $movimiento["cantidad"] = - $detalle["kg"];
            $movimiento["descripcion"] = "Despacho a tintorerias";

            $movimiento_mp = Movimiento_Tela::create($movimiento);

            Resumen_Stock_Tela::calculateCurrentStock($detalle["producto_id"], $detalle["proveedor_id"],-($detalle["kg"]),-($detalle["rollos"]));


            DetallesDespachoTerceros::create($detalle);
          }
      }

      Session::flash('flash_message', 'Datos guardados!');
      return redirect('despacho-terceros/despacho-terceros');

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
        //
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

        $detalles = DetallesDespachoTerceros::where("despacho_id",$id)->get();
        foreach ($detalles as $key => $detalle) {
          $movimiento = array();
          $movimiento["planeacion_id"] = 0;
          $movimiento["proveedor_id"] = $detalle["proveedor_id"];
          $movimiento["producto_id"] = $detalle["producto_id"];
          $movimiento["rollos"] = $detalle["rollos"];
          $movimiento["estado"] = 0;
          $movimiento["cantidad"] = $detalle["cantidad"];
          $movimiento["descripcion"] = "Eliminacion de espacho a tintorerias";
          $movimiento_mp = Movimiento_Tela::create($movimiento);

          Resumen_Stock_Tela::calculateCurrentStock($detalle["producto_id"], $detalle["proveedor_id"],($detalle["cantidad"]),$detalle["rollos"]);

        }

        DespachoTerceros::find($id)->delete();

        Session::flash('flash_message', 'Datos guardados!');
        return redirect('despacho-terceros/despacho-terceros');


    }

    public function getBoleta(Request $request)
    {
      $pdf = App::make('dompdf.wrapper');
      $html = "";
      $despacho = DespachoTerceros::find($request->id);
      $totalpeso = 0;
      $totalcantidad = 0;
      if (!is_null($despacho)) {
        $detalles = DetallesDespachoTerceros::where(["despacho_id" => $despacho->id])
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
}
