<?php

namespace App\Http\Controllers\RecepcionMP;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Recepcion_MP;
use App\Proveedor;
use App\Insumo;
use App\Accesorio;
use App\Marca;
use App\Titulo;
use App\Compra;
use App\DetalleRecepcionMP;
use Carbon\Carbon;
use App\Movimiento_MP;
use App\Resumen_Stock_MP;
use Session;
use DB;

class RecepcionMPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $recepciones = Recepcion_MP::orderBy('id', 'desc')->paginate(25);

      foreach ($recepciones as $key => $value) {
          $recepciones[$key]->detalles = DetalleRecepcionMP::where('recepcion_id', $value->id)->get();
      }

      // if ($request->ajax()) {
      // $recepciones = Recepcion_MP::with('proveedor','detalles','detalles.insumo','detalles.titulo');
      // return Datatables::eloquent($recepciones)
      //                   ->filter(function ($query) use ($request) {


/*                                $q = $request->search["value"];
                              if ($q) {
                                $query->whereHas('empleado', function($query) use ($request,$q){
                                    $query->where('empleados.nombres', 'LIKE', $q);
                                });

                                $query->whereHas('proveedor', function($query) use ($request,$q){
                                    $query->where('proveedores.nombre_comercial', 'LIKE', $q);
                                });

                              }

                              if ($request->has('fecha')){
                                $query->where('fecha', '=', $request->fecha);
                              }

                              if ($request->has('estado')){
                                $query->where('estado', '=', $request->estado);
                              }

                              if ($request->has('turno')) {
                                $query->whereHas('detalles', function($query) use ($request){
                                    $query->where('detalle_planeamientos.turno', '=', $request->turno);
                                });
                              }

                              if ($request->has('proveedor')) {
                                $query->where('proveedor_id', '=', $request->proveedor);
                              }
                              if ($request->has('empleado')) {
                                $query->whereHas('empleado', function($query) use ($request){
                                    $query->where('empleado_id', '=', $request->empleado);
                                });
                              }*/


      //                   })
      //                   ->make(true);
      // }

      return view('recepcion-materia.index',compact('recepciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      $tipo_id = \Config::get("sistema.tipo_proveedor_materia_prima_id");
      $proveedores = Proveedor::select("proveedores.*")
          ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
          ->where("pt.tipo_proveedor_id", "=", $tipo_id)
          ->get();
      $insumos = Insumo::select(
                "insumos.*", 
                DB::raw("(CONCAT(insumos.nombre_generico, ' ', t.nombre)) as nombre_insumo"),
                "t.nombre as titulo"
            )
            ->leftJoin("titulos as t", "t.id", "=", "insumos.titulo_id")
            ->whereRaw("insumos.deleted_at IS NULL")
            ->get();
      $accesorios = Accesorio::all();
      $marcas = Marca::all();
      $titulos = Titulo::all();

      return view('recepcion-materia.create',compact('proveedores','insumos','accesorios','marcas','titulos'));

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

      if ($requestData['nro_guia'] != ''){
          $requestData['estado'] = 2;
      } else{
          $requestData['estado'] = 1;
      }

      $requestData['proveedor_id'] = $requestData['proveedor'];

      /*
       * validate($request, $rules, $messages)
       */
      $this->validate($request, [
          'fecha'             => 'date',
          'proveedor'         => 'required',
          'detalles'          => 'required',
      ],
      [
          'detalles.required' => 'Ingrese al menos un detalle a la compra.'
      ]);


      $recepcion = Recepcion_MP::create($requestData);
      $recepcion->codigo = $recepcion->id;
      $recepcion->save();

      if (isset($recepcion)){
          foreach ($requestData['detalles'] as $detalle) {
              $movimiento = array();
              $movimiento["fecha"] = $requestData["fecha"];
              $movimiento["compra_id"] = 0;
              $movimiento["proveedor_id"] = $requestData["proveedor_id"];
              $movimiento["lote"] = $detalle["nro_lote"];
              $movimiento["insumo_id"] = isset($detalle["insumo_id"])? $detalle["insumo_id"]:0;
              $movimiento["accesorio_id"] = isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;
              $movimiento["titulo_id"] = $detalle["titulo"];
              $movimiento["cantidad"] = $detalle["cantidad_paquetes"];
              $movimiento["estado"] = 0;
              $movimiento["descripcion"] = "Compra";
              $peso_neto = $detalle["peso_bruto"] - $detalle["peso_tara"];
              $movimiento["peso_neto"] = $peso_neto;

              $movimiento_mp = Movimiento_MP::create($movimiento);

              
              $insumo  = isset($detalle["insumo_id"]) ? $detalle["insumo_id"] : 0;
              $accesorio = isset($detalle["accesorio_id"]) ? $detalle["accesorio_id"] : 0;

              Resumen_Stock_MP::calculateCurrentStock($detalle["nro_lote"],$insumo, $accesorio, $requestData["proveedor_id"],$peso_neto, $detalle["cantidad_paquetes"], $detalle["titulo"]);

              $detalle['recepcion_id'] = $recepcion->id;

              DetalleRecepcionMP::create($detalle);
          }
      }

      Session::flash('flash_message', 'Datos guardados!');
      return redirect('recepcion-mp/recepcion-mp');
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
      $recepcion = Recepcion_MP::find($id);
      $detalles = DetalleRecepcionMP::where("recepcion_id",$id)
                                ->get();


      foreach ($detalles as $key => $detalle) {
        $peso_neto = $detalle["peso_bruto"] - $detalle["peso_tara"];
        $insumo  = isset($detalle["insumo_id"]) ? $detalle["insumo_id"] : 0;
        $accesorio = isset($detalle["accesorio_id"]) ? $detalle["accesorio_id"] : 0;

        $resumen = Resumen_Stock_MP::where("lote",$detalle["nro_lote"])
                      ->orderBy("created_at","DESC")
                      ->first();

        $movimiento = array();
        $movimiento["fecha"] = $recepcion->fecha;
        $movimiento["compra_id"] = $recepcion->id;
        $movimiento["proveedor_id"] = $recepcion->proveedor_id;
        $movimiento["lote"] = $detalle["nro_lote"];
        $movimiento["insumo_id"] = $insumo;
        $movimiento["accesorio_id"] = $accesorio;
        $movimiento["titulo_id"] = $detalle["titulo"];
        $movimiento["cantidad"] = -$resumen->cantidad;
        $movimiento["estado"] = 0;
        $movimiento["descripcion"] = "Eliminar recepcion de MP";
        $movimiento["peso_neto"] = $peso_neto;

        $movimiento_mp = Movimiento_MP::create($movimiento);

        Resumen_Stock_MP::calculateCurrentStock($detalle["nro_lote"],$insumo,$accesorio,$recepcion->proveedor_id,$peso_neto, $resumen->cantidad, $detalle["titulo"]);
      }

      Recepcion_MP::destroy($id);

      Session::flash('flash_message', 'Recepcion eliminada!');



      return redirect('recepcion-mp/recepcion-mp');
    }
}
