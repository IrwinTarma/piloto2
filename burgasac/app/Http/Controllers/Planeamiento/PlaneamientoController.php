<?php

namespace App\Http\Controllers\Planeamiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Planeamiento;
use App\Proveedor;
use App\Insumo;
use App\Accesorio;
use App\Marca;
use App\Titulo;
use App\Empleado;
use App\Maquina;
use App\Indicador;
use App\Producto;
use Carbon\Carbon;
use Session;
use App\DetalleCompra;
use App\DetallePlaneamiento;
use App\Movimiento_Tela;
use App\Movimiento_MP;
use App\Resumen_Stock_Tela;
use App\Resumen_Stock_MP;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Excel;
class PlaneamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
          $requestData = $request->all();
          $planeamientos = Planeamiento::with('empleado','maquina','detalles.accesorio','detalles.titulo','detalles.insumo','proveedor','producto');
          //dd($planeamientos);
          return Datatables::eloquent($planeamientos)
                          ->filter(function ($query) use ($request) {


                                $q = $request->search["value"];
                                if ($q) {
                                  $query->whereHas('empleado_id', function($query) use ($request,$q){
                                      $query->where('empleados.nombres', 'LIKE', $q);
                                  });

                                  $query->whereHas('proveedor', function($query) use ($request,$q){
                                      $query->where('proveedores.nombre_comercial', 'LIKE', $q);
                                  });

                                }

                                if ($request->has('fecha')){
                                  $query->where('fecha', '=', $request->fecha);
                                }

                                if($request->has('producto')){
                                  $query->where("producto_id","=",$request->producto);
                                }

                                if($request->has('maquina')){
                                  $query->where("maquina_id","=",$request->maquina);
                                }

                                if ($request->has('estado')){
                                  $query->where('estado', '=', $request->estado);
                                }

                                if ($request->has('turno')) {
                                  $query->where('turno', '=', $request->turno);
                                }

                                if ($request->has('proveedor')) {
                                  $query->where('proveedor_id', '=', $request->proveedor);
                                }
                                if ($request->has('empleado')) {
                                  $query->where('empleado_id', '=', $request->empleado);
                                }
                          })
                          ->make(true);
        }



        $proveedores = Proveedor::all();
        $dataempleados = Empleado::all();
        $empleados = [];
        foreach ($dataempleados as $key => $value) {
          $empleados[$value->id] = $value;
        }
        $productos = Producto::all();
        $maquinas = Maquina::all();

        $planeamientos = Planeamiento::with('proveedor','producto','empleado','maquina')->get();
         //dd($planeamientos);
        foreach ($planeamientos as $key => $planeamiento) {
            $planeamiento->detalles = DetallePlaneamiento::with('insumo')->with('titulo')->with('accesorio')->where('planeamiento_id',$planeamiento->id)->get();
           // dd($planeamiento->detalles);
            foreach ($planeamiento->detalles as $key => &$detalle) {
              # code...
              $detalle->{"accesorio"} = Accesorio::where('id',$detalle->accesorio_id)->select('nombre')->first();
              //dd($detalle->accesorio->nombre);
            }

        }
        //dd($planeamientos[0]->detalles[0]->accesorio->nombre);
        return view('planeamientos.index',compact('planeamientos','proveedores','empleados','productos','maquinas'));
    }

    public function eliminacionProduccion($planeamiento_id){
      $planeamiento = Planeamiento::find($planeamiento_id);
      $detalles = DetallePlaneamiento::where("planeamiento_id",$planeamiento_id)->get();
      $MT = array();
      $MT["planeacion_id"] = $planeamiento_id;
      $MT["producto_id"] = $planeamiento["producto_id"];
      $MT["cantidad"] = -$planeamiento["kg_producidos"];
      $MT["estado"] = 0;
      $MT["proveedor_id"] = $planeamiento["proveedor_id"];
      $MT["rollos"] = -$planeamiento["rollos"] ;
      $MT["descripcion"] = "Cancelacion de Planeamiento de Tela";

      $kg = $planeamiento["kg_producidos"];
      $rollos = $planeamiento["rollos"];

      $mt = Movimiento_Tela::create($MT);
      $lotemaximo = "";
      foreach ($requestData['detalles'] as $detalle) {
        if ($detalle["lote_insumo"]!="0") {
          $lotemaximo = $detalle["lote_insumo"];
        }
      }
      Resumen_Stock_Tela::calculateCurrentStock($planeamiento["producto_id"],$planeamiento["proveedor_id"],-$kg,-$rollos, $lotemaximo);

      $planeamiento->estado = 0;
      $planeamiento->rollos = 0;
      $planeamiento->rollos_falla = 0;
      $planeamiento->kg_producidos = 0;
      $planeamiento->kg_falla = 0;
      $planeamiento->save();
      foreach ($detalles as $key => $detalle) {
        $movimiento = array();
        $movimiento["fecha"] = date("Y-m-d");
        $movimiento["compra_id"] = 0;
        $movimiento["proveedor_id"] = $planeamiento["proveedor_id"];
        $movimiento["lote"] = isset($detalle["lote_insumo"])? $detalle["lote_insumo"] : 0 ;
        $movimiento["insumo_id"] = isset($detalle["insumo_id"])? $detalle["insumo_id"] : 0;
        $movimiento["accesorio_id"] = isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;

        $movimiento["titulo_id"] = $detalle["titulo_id"];
        $movimiento["cantidad"] = $detalle["cantidad"];
        $movimiento["peso_neto"] = (isset($detalle["kg"])? $detalle["kg"] : 0);
        $movimiento["estado"] = 1;
        $movimiento["descripcion"] = "Eliminacion de produccion";

        $movimiento_mp = Movimiento_MP::create($movimiento);
        Resumen_Stock_MP::calculateCurrentStock($movimiento["lote"] ,$movimiento["insumo_id"],$movimiento["accesorio_id"],$planeamiento["proveedor_id"], $movimiento["peso_neto"], $movimiento["cantidad"]);
        $detalle["cajas"] = 0;
        $detalle["kg"] = 0;
        $detalle["mp_producida"] = 0;
        $detalle["cantidad"] = 0;
        $detalle->save();
      }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $lotes_insumo = DB::select(DB::raw("
        SELECT rsm.id, rsm.lote, rsm.cantidad, rsm.insumo_id
        FROM resumen_stock_materiaprima rsm
        WHERE rsm.estado=1 AND rsm.insumo_id!=0 AND cantidad>0 AND peso_neto>0
      "));
      $accesorios = DB::select(DB::raw("
        SELECT acc.id, rsm.lote, rsm.cantidad, acc.nombre, rsm.accesorio_id
        FROM resumen_stock_materiaprima rsm
        INNER JOIN accesorios acc ON acc.id = rsm.accesorio_id
        WHERE rsm.estado=1 AND rsm.accesorio_id!=0
      "));
      $insumos = DB::select(DB::raw("SELECT * FROM ( SELECT insumo_id FROM ( SELECT insumo_id FROM ( SELECT MAX(created_at) AS max_date, lote FROM `resumen_stock_materiaprima` GROUP BY lote ) mp INNER JOIN resumen_stock_materiaprima rs ON mp.max_date = rs.created_at AND mp.lote = rs.lote WHERE cantidad > 0 ) a GROUP BY insumo_id ) ri INNER JOIN insumos i ON ri.insumo_id = i.id"));
      //$accesorios = DB::select(DB::raw("SELECT * FROM ( SELECT accesorio_id FROM ( SELECT accesorio_id FROM ( SELECT MAX(created_at) AS max_date, lote FROM `resumen_stock_materiaprima` GROUP BY lote ) mp INNER JOIN resumen_stock_materiaprima rs ON mp.max_date = rs.created_at AND mp.lote = rs.lote WHERE cantidad > 0 ) a GROUP BY accesorio_id ) ri INNER JOIN accesorios i ON ri.accesorio_id = i.id"));
      $titulos_accesorio = DB::select(DB::raw("
      SELECT DISTINCT titulos.id,titulos.nombre FROM `titulos` INNER JOIN detalle_compras ON detalle_compras.titulo_id = titulos.id INNER JOIN resumen_stock_materiaprima ON resumen_stock_materiaprima.accesorio_id = detalle_compras.accesorio_id WHERE titulos.materia_prima = 'accesorio'"));

      $tipo_id = \Config::get("sistema.tipo_proveedor_planeamiento_id");
      $proveedores = Proveedor::select("proveedores.*")
          ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
          ->where("pt.tipo_proveedor_id", "=", $tipo_id)
          ->get();
          
      $titulos = Titulo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();
      $productos = Producto::all();
      return view('planeamientos.create',compact('proveedores','accesorios','titulos','titulos_accesorio','empleados','maquinas','insumos','productos','lotes_insumo', 'lotes_accesorio'));
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
      $this->validate($request, [
          'fecha'             => 'date',
          'proveedor'         => 'required',
          'detalles'          => 'required',
          'producto'          => 'required',
          "maquina"           => 'required',
          "empleado"          => 'required',
          "detalles"          => 'required'
      ],
      [
          'detalles.required' => 'Ingrese al menos un detalle al planeamiento.'
      ]);

      $requestData["maquina_id"] = $requestData["maquina"];
      $requestData["empleado_id"] = $requestData["empleado"];
      $requestData["producto_id"] = $requestData["producto"];
      $requestData["proveedor_id"] = $requestData["proveedor"];
      $requestData["estado"] = 0;
      $requestData["rollos"] = 0;
      $requestData["kg_producidos"] = 0;
      $requestData["kg_falla"] = 0;

      $requestData["cajas"] = 0;
      $requestData["fecha"] = $requestData["fecha"];


      $planeamiento_id = Planeamiento::create($requestData)->id;
      //dd($planeamiento_id );
      if (isset($planeamiento_id)){
          foreach ($requestData['detalles'] as $detalle) {
            //var_dump($detalle);
              $detalle["fecha"] = $requestData["fecha"];
              $detalle["cajas"] = 0;
              $detalle["Kg"] = 0;
              $detalle["insumo_id"] = isset($detalle["insumo"])? $detalle["insumo"] : 0;
              $detalle["lote_insumo"] = isset($detalle["nro_lote"])? $detalle["nro_lote"] : 0;
              
              
              if (!isset($detalle["titulo_id"])) {
                $detalle["titulo_id"] =  isset($detalle["titulo"])? $detalle["titulo"] : 0;
              }
              //dd($detalle["titulo_id"]);

              //echo "titulo_id == ".$detalle["titulo_id"];
              $detalle["mp_producida"] = 0;
              $detalle["accesorio_id"] = isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;
              $detalle["cantidad"] = isset($detalle["cantidad"])? $detalle["cantidad"] : 0;
              if ($detalle["accesorio_id"]!=0) {

                $titulo_id = DetalleCompra::where('accesorio_id',$detalle["accesorio_id"])->select('titulo_id')->first();
              }else {
                $titulo_id = DetalleCompra::where('insumo_id',$detalle["insumo_id"])->select('titulo_id')->first();
              }
              //dd($titulo_id->titulo_id);

              //$detalle["titulo_id"]=$titulo_id->titulo_id;
              $detalle["lote_accesorio"] = "undefined";


              $detalle["planeamiento_id"] = $planeamiento_id;
              //dd($detalle);
              DetallePlaneamiento::create($detalle);
          }
          //dd();
      }

      Session::flash('flash_message', 'Datos guardados!');
      return redirect('planeamientos/planeamientos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $lotes_insumo = DB::select(DB::raw("
        SELECT rsm.id, rsm.lote, rsm.cantidad, rsm.insumo_id
        FROM resumen_stock_materiaprima rsm
        WHERE rsm.estado=1 AND rsm.insumo_id!=0
      "));
      $accesorios = DB::select(DB::raw("
        SELECT acc.id, rsm.lote, rsm.cantidad, acc.nombre, rsm.accesorio_id
        FROM resumen_stock_materiaprima rsm
        INNER JOIN accesorios acc ON acc.id = rsm.accesorio_id
        WHERE rsm.estado=1 AND rsm.accesorio_id!=0
      "));

      $proveedores = Proveedor::all();
      //$accesorios = Accesorio::all();
      $titulos = Titulo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();
      $insumos = Insumo::all();
      $productos = Producto::all();

      $planeamiento = Planeamiento::findOrFail($id);

      $planeamiento->detalles = DetallePlaneamiento::with('insumo','titulo')->where('planeamiento_id',$planeamiento->id)->get();
      //dd($planeamiento);

      return view('planeamientos.show', compact('proveedores','accesorios','titulos','empleados','planeamiento','maquinas','insumos','productos', 'lotes_accesorio', 'lotes_insumo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $lotes_insumo = DB::select(DB::raw("
        SELECT rsm.id, rsm.lote, rsm.cantidad, rsm.insumo_id
        FROM resumen_stock_materiaprima rsm
        WHERE rsm.estado=1 AND rsm.insumo_id!=0
      "));
      $accesorios = DB::select(DB::raw("
        SELECT acc.id, rsm.lote, rsm.cantidad, acc.nombre, rsm.accesorio_id
        FROM resumen_stock_materiaprima rsm
        INNER JOIN accesorios acc ON acc.id = rsm.accesorio_id
        WHERE rsm.estado=1 AND rsm.accesorio_id!=0
      "));

      $proveedores = Proveedor::all();
      //$accesorios = Accesorio::all();
      //$titulos_accesorio = Titulo::where('materia_prima', 'accesorio')->get();
      $titulos_accesorio = DB::select(DB::raw("
      SELECT DISTINCT titulos.id,titulos.nombre FROM `titulos` INNER JOIN detalle_compras ON detalle_compras.titulo_id = titulos.id INNER JOIN resumen_stock_materiaprima ON resumen_stock_materiaprima.accesorio_id = detalle_compras.accesorio_id WHERE titulos.materia_prima = 'accesorio'"));
      $titulos = Titulo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();
      $insumos = Insumo::all();
      $productos = Producto::all();

      // $compra->accesorios = DetallePlaneamiento::with("titulo","accesorio")->whereNotNull("accesorio_id")->where("compra_id",$id)->get();
      // $compra->insumos = DetallePlaneamiento::with("titulo","insumo")->whereNotNull("insumo_id")->where("compra_id",$id)->get();

      $planeamiento = Planeamiento::findOrFail($id);
      $planeamiento->detalles = DetallePlaneamiento::with('insumo','titulo','accesorio')->where('planeamiento_id',$planeamiento->id)->get();
      $planeamiento->accesorios = DetallePlaneamiento::with("titulo","accesorio")->whereNotNull("accesorio_id")->where("planeamiento_id",$id)->get();
      $planeamiento->insumos = DetallePlaneamiento::with("titulo","insumo")->where("accesorio_id",0)->where("planeamiento_id",$id)->get();
      //dd($planeamiento->insumos);
      return view('planeamientos.edit', compact('proveedores','accesorios','titulos','titulos_accesorio','empleados','planeamiento','maquinas','insumos','productos', 'lotes_accesorio', 'lotes_insumo'));
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
      $requestData = $request->all();
      /*
       * validate($request, $rules, $messages)
       */
      $this->validate($request, [
        'fecha'             => 'date',
        'detalles'          => 'required',
        'producto'          => 'required',
        'maquina'           => 'required',
        'empleado'          => 'required',

      ]);

      $requestData["producto_id"] = $requestData["producto"];
      $requestData["maquina_id"] = $requestData["maquina"];
      $requestData["empleado_id"] = $requestData["empleado"];
      $requestData["accesorio_id"] = $requestData["accesorio"];
      $requestData["fecha"] = $requestData["fecha"];

      $planeamiento = Planeamiento::findOrFail($id);
      $planeamiento->update($requestData);

      DetallePlaneamiento::where('planeamiento_id', $id)->delete();
      foreach ($requestData['detalles'] as $detalle) {


          $detalle["cajas"] = 0;
          $detalle["fecha"] = $requestData["fecha"];
          $detalle["Kg"] = 0;
          $detalle["lote_insumo"] = isset($detalle["nro_lote"])? $detalle["nro_lote"] : 0;
          $detalle["mp_producida"] = 0;
          if (!isset($detalle["titulo_id"])) {
                $detalle["titulo_id"] =  isset($detalle["titulo"])? $detalle["titulo"] : 0;
          }
          $detalle["cantidad"] = isset($detalle["cantidad"])? $detalle["cantidad"] : 0;
          $detalle["lote_accesorio"] = "0";
          // if (isset($detalle["accesorio_id"])) {
          //
          //   $titulo_id = DetalleCompra::where('accesorio_id',$detalle["accesorio_id"])->select('titulo_id')->first();
          // }else {
          //   $titulo_id = DetalleCompra::where('insumo_id',$detalle["insumo_id"])->select('titulo_id')->first();
          // }
          // dd($titulo_id->titulo_id);
          //
          // $detalle["titulo_id"]=$titulo_id->titulo_id;
          $detalle["planeamiento_id"] = $id;

          DetallePlaneamiento::create($detalle);
      }


      Session::flash('flash_message', 'Planeamiento actualizada!');

      return redirect('planeamientos/planeamientos');
    }

    public function liquidacion($id){

      $proveedores = Proveedor::all();
      $accesorios = Accesorio::all();
      $titulos = Titulo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();
      $insumos = Insumo::all();
      $productos = Producto::all();
      $indicadores = [];

      $planeamiento = Planeamiento::findOrFail($id);
      $producto_id = $planeamiento->producto_id;
      $planeamiento->detalles = DetallePlaneamiento::with('insumo','titulo')->where('planeamiento_id',$planeamiento->id)->get();
      foreach ($planeamiento->detalles as $key => $value) {
        $indicadores[] = Indicador::where(["producto_id" => $producto_id, "insumo_id"=> $value->insumo_id, "titulo_id" => $value->titulo_id])->first();
      }
      $planeamiento->estado = Planeamiento::where('id',$planeamiento->id)->select('estado')->first();
      foreach ($planeamiento->detalles as $key => $detalle) {
        if ($detalle->insumo_id ==0) {

          $detalle->cantidad_maxima = Resumen_Stock_MP::where('accesorio_id',$detalle->accesorio_id)->select('cantidad')->first();
        }
        else {
          $detalle->cantidad_maxima = Resumen_Stock_MP::where('lote',$detalle->lote_insumo)->select('cantidad')->first();
        }
        if ($detalle->cantidad_maxima == null) {
          $detalle->cantidad_maxima = (object)[

            'cantidad' => 0
          ];
          // foreach ($detalle->cantidad_maxima as $key => $cantidad) {
          //   $cantidad->{"cantidad"} = 0;
          // }
        }

      }
      //dd($planeamiento);
      // $planeamiento->accesorio = DB::table('detalle_planeamientos')
      // ->join('accesorios', 'detalle_planeamientos.accesorio_id', '=', 'accesorios.id')
      // ->join('titulos', 'detalle_planeamientos.titulo_id', '=', 'titulos.id')
      // ->where('planeamiento_id',$planeamiento->id)
      // ->select('detalle_planeamientos.accesorio_id','titulos.nombre as tnombre' ,'detalle_planeamientos.titulo_id', 'accesorios.nombre', 'detalle_planeamientos.cantidad','detalle_planeamientos.id')
      // ->get();
    //  dd($planeamiento->detalles,$planeamiento->accesorio);
      //dd($planeamiento);
      //dd($planeamiento);
      return view('planeamientos.liquidacion.edit',compact('planeamiento','proveedores','accesorios','titulos','empleados','maquinas','insumos','productos', 'indicadores'));
    }

    public function aLiquidacion(Request $request,$id){
      $requestData = $request->all();
      //dd($requestData);
      $this->validate($request, [
        'rollos'            => 'required',
        'detalles'          => 'required',
        'kg_producidos'     => 'required',
        'kg_falla'          => 'required',
        'detalles'          => 'required'
        ],
        [
            'detalles.required' => 'Ingrese al menos un detalle a la compra.'
        ]);
      $requestData["kg_falla"] = $requestData["kg_falla"];
      $requestData["rollos_falla"] = $requestData["rollos_falla"];
      $requestData["kg_producidos"]=  $requestData["kg_producidos"];
      $requestData["rollos"] = $requestData["rollos"];

      $peso_neto = $requestData["kg_producidos"] - $requestData["kg_falla"];
      $rollostotal = $requestData["rollos"] - $requestData["rollos_falla"];
      $lotemaximo = "";
      foreach ($requestData['detalles'] as $detalle) {
        if ($detalle["lote_insumo"]!="0") {
          $lotemaximo = $detalle["lote_insumo"];
        }
      }
      $planeamiento = Planeamiento::findOrFail($id);

      $requestData["estado"] = 1;
      $planeamiento->update($requestData);

      $MT = array();
      $MT["planeacion_id"] = $id;
      $MT["producto_id"] = $planeamiento["producto_id"];
      $MT["cantidad"] = $peso_neto;
      $MT["estado"] = 0;
      $MT["proveedor_id"] = $planeamiento["proveedor_id"];
      $MT["rollos"] = $rollostotal;
      $MT["descripcion"] = "Planeamiento de Tela";
      $MT["nro_lote"] = $lotemaximo;
      $mt = Movimiento_Tela::create($MT);

      Resumen_Stock_Tela::calculateCurrentStock($planeamiento["producto_id"],$planeamiento["proveedor_id"], $MT["cantidad"], $MT["rollos"], $lotemaximo);

      // $detallePlaneamiento = DetallePlaneamiento::where("planeamiento_id",$id)->first();
      // $indicador = Indicador::where("producto_id",$planeamiento["producto_id"])
      //                       ->where("insumo_id",$detallePlaneamiento["insumo_id"])
      //                       ->first();
      // if($indicador==null)   return redirect('/planeamientos/planeamientos');




      
      foreach ($requestData['detalles'] as $detalle) {

          $detallePlaneamiento = DetallePlaneamiento::findOrFail($detalle["id"]);
          $indicador = Indicador::where("producto_id",$planeamiento["producto_id"])
                                ->where("insumo_id",$detallePlaneamiento["insumo_id"])
                                ->where("titulo_id", $detallePlaneamiento["titulo_id"])
                                ->first();

          //dd($detalle);
          // $nro_lote = isset($detalle["lotes_insumo"])? $detalle["lotes_insumo"] : 0;
          // $peso_neto = $detalle["peso_bruto"] - $detalle["peso_tara"];
          // $insumo  = isset($detalle["insumo_id"]) ? $detalle["insumo_id"] : 0;
          // $accesorio = isset($detalle["accesorio_id"]) ? $detalle["accesorio_id"] : 0;
          // if ($peso_neto==null) {
          //   $peso_neto = 0;
          // }
          // Resumen_Stock_MP::calculateCurrentStock($nro_lote,$insumo,$accesorio,$compra->proveedor_id,-$peso_neto, -$detalle["cantidad"]);
          $movimiento = array();
          $movimiento["fecha"] = $requestData["fecha"];
          $movimiento["compra_id"] = 0;
          $movimiento["proveedor_id"] = $planeamiento["proveedor_id"];
          $movimiento["lote"] = isset($detalle["lote_insumo"])? $detalle["lote_insumo"] : 0 ;
          $movimiento["insumo_id"] = isset($detallePlaneamiento["insumo_id"])? $detallePlaneamiento["insumo_id"] : 0;
          $movimiento["accesorio_id"] = isset($detalle["id_accesorio"])? $detalle["id_accesorio"]:0;

          $movimiento["titulo_id"] = $detalle["titulo_id"];
          if ($movimiento["accesorio_id"]==0) {

            $movimiento["cantidad"] = -$detalle["cantidad_mp"];
          }
          else {
            $movimiento["cantidad"] = -$detalle["cantidad_accesorio"];
          }
          $movimiento["peso_neto"] = -(isset($detalle["materia"])? $detalle["materia"] : 0);
          $movimiento["peso_neto"] = $movimiento["peso_neto"];
          $movimiento["estado"] = 1;
          $movimiento["descripcion"] = "Liquidacion";
        
          Resumen_Stock_MP::calculateCurrentStock($movimiento["lote"] ,$movimiento["insumo_id"],$movimiento["accesorio_id"],$planeamiento["proveedor_id"],$movimiento["peso_neto"] ,$movimiento["cantidad"], $movimiento["titulo_id"]);

          $mat_pro = $requestData["kg_producidos"];
          $detalle["cantidad"] = -$movimiento["cantidad"];
          $detalle["Kg"] = isset($detalle["materia"])? $detalle["materia"] : 0;
          $detalle["cajas"] = isset($detalle["cajas"])? $detalle["cajas"] : 0;
          $detalle["mp_producida"] = $mat_pro;

          $detallePlaneamiento->update($detalle);
      }

      return redirect('/planeamientos/planeamientos');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Planeamiento::destroy($id);

      Session::flash('flash_message', 'Planeamiento deleted!');

      return redirect('planeamientos/planeamientos');
    }

    public function genExcel(Request $request){
      // SELECT p.fecha 'Fecha', pr.nombre_comercial 'Proveedor', CONCAT(e.nombres,' ',e.apellidos) 'Colaborador', p.turno 'Turno',m.nombre 'Maquina',prd.nombre_generico 'Producto', dp.lote_insumo 'Lote',i.nombre_generico 'MP', t.nombre 'Titulo',dp.cajas 'Cajas', dp.Kg 'Kg', p.rollos 'Rollos',p.kg_producidos 'Kg Pr', p.kg_falla 'Falla Kg' FROM planeamientos p INNER JOIN detalle_planeamientos dp ON p.id = dp.planeamiento_id INNER JOIN empleados e ON e.id = p.empleado_id INNER JOIN maquinas m ON m.id = p.maquina_id LEFT JOIN accesorios a ON a.id = dp.accesorio_id INNER JOIN titulos t ON t.id = dp.titulo_id LEFT JOIN insumos i ON i.id = dp.insumo_id INNER JOIN proveedores pr ON pr.id = p.proveedor_id INNER JOIN productos prd ON prd.id = p.producto_id

      $producto = $request->producto;
      $maquina = $request->maquina;
      $proveedor = $request->proveedor;
      $empleado = $request->colaborador;
      $fecha = $request->date;

      $planeamientos_query = DB::table("planeamientos")
          ->join("detalle_planeamientos","detalle_planeamientos.planeamiento_id","=","planeamientos.id")
          ->join("empleados","planeamientos.empleado_id","=","empleados.id")
          ->join("maquinas","planeamientos.maquina_id","=","maquinas.id")
          ->join("proveedores","planeamientos.proveedor_id","=","proveedores.id")
          ->join("productos","productos.id","=","planeamientos.producto_id")
          ->join("titulos","detalle_planeamientos.titulo_id","=","titulos.id")
          ->leftJoin("accesorios","accesorios.id","=","detalle_planeamientos.accesorio_id")
          ->leftJoin("insumos","insumos.id","=","detalle_planeamientos.insumo_id");


      if($fecha) $planeamientos_query->where("planeamientos.fecha","=",$fecha);
      if($producto) $planeamientos_query->where("producto_id","=",$producto);
      if($maquina) $planeamientos_query->where("maquina_id","=",$maquina);
      if($proveedor) $planeamientos_query->where("planeamientos.proveedor_id","=",$proveedor);
      if($empleado) $planeamientos_query->where("empleado_id","=",$empleado);

      $planeamientos_query->select('detalle_planeamientos.id as ID','planeamientos.fecha as Fecha','proveedores.nombre_comercial as Proveedor',DB::raw("CONCAT(empleados.nombres,' ',empleados.apellidos) as Tejedor"),'planeamientos.turno as Turno','maquinas.nombre as Maquina','productos.nombre_generico as Producto','detalle_planeamientos.lote_insumo as Lote', DB::raw("IFNULL(insumos.nombre_generico, 'Agujas') as 'Materia Prima/Agujas' "),'titulos.nombre as Titulo', 'detalle_planeamientos.cantidad as Cant', DB::raw("planeamientos.kg_producidos as 'KG Pr'"), 'planeamientos.rollos as Rollos', DB::raw("planeamientos.kg_falla as 'Falla Kg'"),DB::raw("planeamientos.rollos_falla as 'Rollos F'"));

      $planeamientos = $planeamientos_query->get();

      // $planeamientos = DB::select(DB::raw("SELECT p.fecha 'Fecha', pr.nombre_comercial 'Proveedor', CONCAT(e.nombres,' ',e.apellidos) 'Colaborador', p.turno 'Turno',m.nombre 'Maquina',prd.nombre_generico 'Producto', dp.lote_insumo 'Lote',i.nombre_generico 'MP', t.nombre 'Titulo',dp.cajas 'Cajas', dp.Kg 'Kg', p.rollos 'Rollos',p.kg_producidos 'Kg Pr', p.kg_falla 'Falla Kg' FROM planeamientos p INNER JOIN detalle_planeamientos dp ON p.id = dp.planeamiento_id INNER JOIN empleados e ON e.id = p.empleado_id INNER JOIN maquinas m ON m.id = p.maquina_id LEFT JOIN accesorios a ON a.id = dp.accesorio_id INNER JOIN titulos t ON t.id = dp.titulo_id LEFT JOIN insumos i ON i.id = dp.insumo_id INNER JOIN proveedores pr ON pr.id = p.proveedor_id INNER JOIN productos prd ON prd.id = p.producto_id"));

      $objPlaneamientos = $planeamientos;
      $planeamientos = array();
      foreach ($objPlaneamientos as $objPlaneamiento) {
        $planeamientos[] = (array)$objPlaneamiento;
      }


      Excel::create('Excel_Ingreso_MP_'.date("Ymdhis"), function($excel) use($planeamientos) {
          $excel->sheet('Sheetname', function($sheet) use($planeamientos) {
              $sheet->setAllBorders('thin');
              $sheet->mergeCells('A1:P1');
              $sheet->row(1, array(
               'Impresion para el ingreso de MP'
              ));

              $sheet->cell('A1', function($cell) {
                  $cell->setFont(array(
                      'family'     => 'Calibri',
                      'size'       => '16',
                      'bold'       =>  true
                  ));
                  $cell->setAlignment('center');

              });

              $sheet->cell('A3:O3', function($cells) {
                $cells->setFont(array(
                    'family'     => 'Calibri',
                    'size'       => '12',
                    'bold'       =>  true
                ));
              });

              $sheet->fromArray($planeamientos, null, 'A3', false, true);

          });

      })->export('xls');

    }



    public function stockTelas($tela_id,$proveedor_id){
      $resumen = Resumen_Stock_Tela::where("producto_id",$tela_id)
                        ->where(["proveedor_id" => $proveedor_id])
                        ->first();
      if (!is_null($resumen)) {
        return(["rollos" => $resumen->rollos, "cantidad" => $resumen->cantidad]);
      } else {
        return(["rollos" => 0, "cantidad" => 0]);
      }

    }

    public function despacho(){
      $proveedores = Proveedor::all();
      $accesorios = Accesorio::all();
      $titulos = Titulo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();
      $insumos = Insumo::all();
      $productos = Producto::all();

      return view('tintoreria.despacho',compact('proveedores','empleados'));
    }
}
