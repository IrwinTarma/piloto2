<?php

namespace App\Http\Controllers\Compra;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Compra;
use Illuminate\Http\Request;
use Session;

use App\DetalleCompra;
use App\Proveedor;
use App\Insumo;
use App\Accesorio;
use App\Marca;
use App\Procedencia;
use App\Titulo;
use Datatables;
use Carbon\Carbon;
use App\Movimiento_MP;
use App\Resumen_Stock_MP;
use App\ProveedorTipo;
use App\Recepcion_MP;

use DB;
use PDF;
use App;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $compras = Compra::select(
          "compras.*", 
           DB::raw("IFNULL((SELECT COUNT(*) FROM detalle_planeamientos AS dp 
            LEFT JOIN detalle_compras AS dc ON dp.lote_insumo = dc.nro_lote 
            WHERE dc.compra_id = compras.id 
            GROUP BY dp.lote_insumo),0) AS cantidadplaneamiento")
           )->orderBy('compras.fecha', 'desc')->paginate(25);
        //$comprasex = Compra::all();
        foreach ($compras as $key => $value) {
            $compras[$key]->detalles = DetalleCompra::where('compra_id', $value->id)->get();
        }
        //dd($comprasex);
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipo_id = \Config::get("sistema.tipo_proveedor_compra_id");
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
        $procedencias = Procedencia::all();
        $data_titulos_insumo = Titulo::where('materia_prima', 'insumo')->get();
        $titulos_insumo = [];
        foreach ($data_titulos_insumo as $key => $value) {
          $titulos_insumo[$value->id] = $value;
        }
        $titulos_accesorio = Titulo::where('materia_prima', 'accesorio')->get();

        return view('compras.create', compact('proveedores', 'insumos', 'accesorios', 'procedencias', 'titulos_insumo', 'titulos_accesorio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function store(Request $request)
    {
        $requestData = $request->all();
        //  dd($requestData);
        $this->validate($request, [
            'fecha'             => 'required|date',
            'procedencia_id'    => 'required',
            'proveedor'         => 'required',
            'detalles'          => 'required',
        ],
        [
            'detalles.required' => 'Ingrese al menos un detalle a la compra.',
            'procedencia_id.required' => 'El campo procedencia es obligatorio.'
        ]);

        $requestData['estado'] = $requestData['nro_guia'] != ''? 2 : 1;
        $requestData['proveedor_id'] = $requestData['proveedor'];

        $ultima_compra = Compra::limit(1)->orderBy('created_at', 'desc')->get();
        $requestData['codigo'] = count($ultima_compra) == 1? $ultima_compra[0]['attributes']['codigo'] + 1 : 1;

        $compra_id = Compra::create($requestData)->id;



        if (isset($compra_id)){
            foreach ($requestData['detalles'] as $detalle) {

              $detalle['compra_id'] = $compra_id;
              DetalleCompra::create($detalle);

              if($requestData['estado']==2){

                  $movimiento = array();
                  $movimiento["fecha"] = $requestData['fecha'];
                  $movimiento["compra_id"] = $compra_id;
                  $movimiento["proveedor_id"] = $requestData["proveedor_id"];
                  $movimiento["lote"] = isset($detalle["nro_lote"])? $detalle["nro_lote"] : 0;
                  $movimiento["insumo_id"] = isset($detalle["insumo_id"])? $detalle["insumo_id"] : 0;
                  $movimiento["accesorio_id"] = isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;
                  $movimiento["titulo_id"] = $detalle["titulo_id"];
                  $movimiento["cantidad"] = $detalle["cantidad"];
                  $movimiento["peso_neto"] = isset($detalle["peso_neto"])? $detalle["peso_neto"] : 0;
                  $movimiento["estado"] = 1;
                  $movimiento["descripcion"] = "Compra";

                  $movimiento_mp = Movimiento_MP::create($movimiento);

                  $peso_neto = ( isset($detalle["peso_bruto"]) && isset($detalle["peso_tara"]))? $detalle["peso_bruto"] - $detalle["peso_tara"] : 0;
                  $insumo  = isset($detalle["insumo_id"]) ? $detalle["insumo_id"] : 0;
                  $accesorio = isset($detalle["accesorio_id"]) ? $detalle["accesorio_id"] : 0;

                  Resumen_Stock_MP::calculateCurrentStock($movimiento["lote"],$insumo, $accesorio, $movimiento["proveedor_id"],$peso_neto,$detalle["cantidad"], $detalle["titulo_id"]);

              }
            }
        }

        Session::flash('flash_message', 'Datos guardados!');
        return redirect('compra/compras');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $compra = Compra::findOrFail($id);

        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $proveedores = Proveedor::all();
        
        $insumos = Insumo::select(
                "insumos.*", 
                DB::raw("(CONCAT(insumos.nombre_generico, ' ', t.nombre)) as nombre_insumo"),
                "t.nombre as titulo"
            )
            ->leftJoin("titulos as t", "t.id", "=", "insumos.titulo_id")
            ->whereRaw("insumos.deleted_at IS NULL")
            ->get();
        $accesorios = Accesorio::all();
        $procedencias = Procedencia::all();
        $data_titulos_insumo = Titulo::where('materia_prima', 'insumo')->get();
        $titulos_insumo = [];
        foreach ($data_titulos_insumo as $key => $value) {
          $titulos_insumo[$value->id] = $value;
        }
        $titulos_accesorio = Titulo::where('materia_prima', 'accesorio')->get();


        $compra = Compra::findOrFail($id);
        $esRecepcionado = $compra->estado==2;

        $compra->detalles = DetalleCompra::where('compra_id', $compra->id)->get();
        $compra->accesorios = DetalleCompra::with("titulo","accesorio")->whereNotNull("accesorio_id")->where("compra_id",$id)->get();
        $compra->insumos = DetalleCompra::with("titulo","insumo")->whereNotNull("insumo_id")->where("compra_id",$id)->get();
        //dd($esRecepcionado);
        return view('compras.edit', compact('compra', 'proveedores', 'insumos', 'accesorios', 'procedencias', 'titulos_insumo', 'titulos_accesorio','esRecepcionado'));
    }

    public function titulo($id){
      $titulo_id = DetalleCompra::where('nro_lote',$id)
                    ->first();
      $titulos = Titulo::where('id',$titulo_id->titulo)
                         ->get();
        return $titulos;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
          'procedencia_id'       => 'required',
          'nro_guia'          => 'required',
          'nro_comprobante'   => 'required',
          'detalles'          => 'required',
        ],
        [
          'detalles.required' => 'Ingrese al menos un detalle a la compra.'
        ]);
        $requestData = $request->all();
        $requestData['estado'] = 2;
        /*
         * validate($request, $rules, $messages)
         */
        $this->validate($request, [
            'procedencia_id'    => 'required',
            'nro_guia'          => 'required',
            'nro_comprobante'   => 'required',
            'detalles'          => 'required',
        ],
        [
            'detalles.required' => 'Ingrese al menos un detalle a la compra.'
        ]);

        $compra = Compra::findOrFail($id);

        if($compra->estado!=3){
          $dataupdate = $requestData;
          unset($dataupdate["fecha"]);
          $compra->update($dataupdate);

          foreach ($requestData['detalles'] as $detalle) {
              $detalle['compra_id'] = $id;
              if (isset($detalle["insumo_id"])) {
                # code...
                $detalle_compra=DetalleCompra::where('compra_id', $id)->where('insumo_id',$detalle["insumo_id"])->first();
                DetalleCompra::where('compra_id', $id)->where('insumo_id',$detalle["insumo_id"])->delete();
              }
              else {
                # code...
                $detalle_compra=DetalleCompra::where('compra_id', $id)->where('accesorio_id',$detalle["accesorio_id"])->first();
                DetalleCompra::where('compra_id', $id)->where('accesorio_id',$detalle["accesorio_id"])->delete();
              }

              $insumo = isset($detalle["insumo_id"])? $detalle["insumo_id"]:0 ;
              $accesorio = isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;

              $peso_bruto = isset($detalle["peso_bruto"])? $detalle["peso_bruto"]:0;
              $peso_tara = isset($detalle["peso_tara"])? $detalle["peso_tara"]:0;
              $peso_neto = $peso_bruto - $peso_tara;
              $cantidad_resumen = $detalle["cantidad"]-$detalle_compra->cantidad;
              $peso_neto_resumen= $peso_neto - ($detalle_compra->peso_bruto - $detalle_compra->peso_tara);
              $nro_lote = isset($detalle["nro_lote"])? $detalle["nro_lote"]:0;
              $movimiento = array();
              $movimiento["fecha"] = $requestData["fecha"];
              $movimiento["compra_id"] = $id;
              $movimiento["proveedor_id"] = $compra->proveedor_id;
              $movimiento["lote"] = $nro_lote;
              $movimiento["insumo_id"] = $insumo;
              $movimiento["accesorio_id"] = $accesorio;
              $movimiento["titulo_id"] = $detalle["titulo_id"];
              $movimiento["cantidad"] = $detalle["cantidad"];
              $movimiento["peso_neto"] = $peso_neto;
              $movimiento["estado"] = 1;
              $movimiento["descripcion"] = "Editar compra";

              $movimiento_mp = Movimiento_MP::create($movimiento);

              Resumen_Stock_MP::calculateCurrentStock($nro_lote,$insumo, $accesorio, $compra->proveedor_id,$peso_neto_resumen,$cantidad_resumen, $detalle["titulo_id"]);

              DetalleCompra::create($detalle);
          }
          Session::flash('flash_message', 'Compra actualizada!');

          return redirect('compra/compras');

        }
        return redirect('compra/compras');
    }

    public function verifica_guia(Request $request)
    {
      $guia = $request["guia"];
      $proveedor = $request["proveedor"];
      return $bandera = Compra::where(["nro_guia" => $guia, "proveedor_id" => $proveedor])
      ->whereRaw("deleted_at IS NULL")
      ->first();
    }
    public function verifica_comprobante(Request $request)
    {
      $comprobante = $request["nro_comprobante"];
      $proveedor = $request["proveedor"];
      return $bandera = Compra::where(["nro_comprobante" => $comprobante, "proveedor_id" => $proveedor])
      ->whereRaw("deleted_at IS NULL")
      ->first();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $compra = Compra::find($id);
        $movimiento_compras = Movimiento_MP::where("compra_id",$id)
        ->get();
        foreach ($movimiento_compras as $key => $movimiento_compra) {
          //$movimiento_compra->estado=0;
          $movimiento_compra["estado"]=0;
          $movimiento_compra->save();
        }
        //dd($movimiento_compras);
        $detalles = DetalleCompra::where("compra_id",$id)
                                  ->get();
        foreach ($detalles as $key => $detalle) {
          //dd( $detalle["peso_bruto"] , $detalle["peso_tara"]);
          $peso_neto = $detalle["peso_bruto"] - $detalle["peso_tara"];
          $insumo  = isset($detalle["insumo_id"]) ? $detalle["insumo_id"] : 0;
          $accesorio = isset($detalle["accesorio_id"]) ? $detalle["accesorio_id"] : 0;
          if ($peso_neto==null) {
            $peso_neto = 0;
          }
          $resumen = Resumen_Stock_MP::where("lote",$detalle["nro_lote"])
                        ->orderBy("created_at","DESC")
                        ->first();
          $movimiento = array();
          $nro_lote = isset($detalle["nro_lote"])? $detalle["nro_lote"] : 0;
          $movimiento["fecha"] = $compra->fecha;
          $movimiento["compra_id"] = $id;
          $movimiento["proveedor_id"] = $compra->proveedor_id;
          $movimiento["lote"] = $nro_lote;
          $movimiento["insumo_id"] = $insumo;
          $movimiento["accesorio_id"] = $accesorio;
          $movimiento["titulo_id"] = $detalle["titulo_id"];
          $movimiento["cantidad"] = -$detalle["cantidad"];
          $movimiento["peso_neto"] = $peso_neto;
          $movimiento["estado"] = 0;
          $movimiento["descripcion"] = "Eliminar compra";
          //dd($movimiento);
          $movimiento_mp = Movimiento_MP::create($movimiento);

          Resumen_Stock_MP::calculateCurrentStock($nro_lote,$insumo,$accesorio,$compra->proveedor_id,-$peso_neto, -$detalle["cantidad"], $detalle["titulo_id"]);
          $detalle->delete();
        }


        // $resumen = Movimiento_MP::where("compra_id",$id)->first();
        // if($resumen)   $resumen->delete();

        Compra::destroy($id);

        Session::flash('flash_message', 'Compra deleted!');



        return redirect('compra/compras');
    }

    public function accesorios($id){
      $detallescompra = DetalleCompra::where('accesorio_id',$id)
                        ->get();
      return $detallescompra;

    }

    public function insumos($id){
      $detallescompra = DetalleCompra::where('insumo_id',$id)
                        ->get();
      return $detallescompra;

    }

    public function detallesCompraAccesorioByLote($id)
    {
      $detallescompra = DB::select(DB::raw("
        SELECT rsm.lote, rsm.accesorio_id, acc.nombre nombre_accesorio, rsm.cantidad
        FROM resumen_stock_materiaprima rsm
        INNER JOIN accesorios acc
        WHERE rsm.estado=1 AND rsm.accesorio_id!=0 AND rsm.accesorio_id=acc.id AND rsm.lote='$id'
      "));
      return $detallescompra;
    }

    public function detallesCompraInsumoByLote(Request $request)
    {
      $lote = $request["lote"];
      $proveedor_id = $request["proveedor_id"];
      $tipo_id = \Config::get("sistema.tipo_proveedor_burgasac_id");
      if ($proveedor_id!="") {
        $proveedor = ProveedorTipo::where(["proveedor_id" => $proveedor_id])->get();
        $tipos = [];
        foreach ($proveedor as $key => $value) {
          $tipos[] = $value->tipo_proveedor_id;
        }

        if (count($tipos) > 0 ) {
          if (in_array($tipo_id, $tipos)) {
            $detallescompra = DB::select(DB::raw("
            SELECT dc.titulo_id titulo_id, ti.nombre nombre_titulo, rsm.insumo_id, ins.nombre_generico nombre_insumo
            FROM detalle_compras dc
            INNER JOIN resumen_stock_materiaprima rsm
            INNER JOIN titulos ti INNER JOIN insumos ins
            WHERE rsm.estado=1 AND rsm.insumo_id!=0 AND rsm.lote=dc.nro_lote AND dc.nro_lote='$lote'
            AND dc.titulo_id=ti.id AND dc.insumo_id=ins.id"));
          return $detallescompra;
        } else {
          $detallescompra = DB::select(DB::raw("
            SELECT dc.titulo as titulo_id, ti.nombre as nombre_titulo, rsm.insumo_id, ins.nombre_generico nombre_insumo
            FROM recepcion_mp_detalles dc
            INNER JOIN resumen_stock_materiaprima rsm
            INNER JOIN titulos ti INNER JOIN insumos ins
            WHERE rsm.estado=1 AND rsm.insumo_id!=0 AND rsm.lote=dc.nro_lote AND dc.nro_lote='$lote'
            AND dc.titulo=ti.id AND dc.insumo_id=ins.id"));
          return $detallescompra;
        }
        } else {
          return [];
        }
      } else {
        return [];
      }
      
    }

    public function getLotesporproveedor(Request $request)
    {
      $proveedor_id = $request["proveedor_id"];
      $tipo_id = \Config::get("sistema.tipo_proveedor_burgasac_id");
      if ($proveedor_id!="") {
        $proveedor = ProveedorTipo::where(["proveedor_id" => $proveedor_id])->get();
        $tipos = [];
        foreach ($proveedor as $key => $value) {
          $tipos[] = $value->tipo_proveedor_id;
        }
        if (count($tipos)) {

          if (in_array($tipo_id, $tipos)) {
            $lotes = Compra::select("compras.*", "dc.nro_lote")
              ->where(["estado" => 2])
              ->leftJoin("detalle_compras as dc", "dc.compra_id", "=", "compras.id")
              ->whereRaw("nro_lote IS NOT NULL")
              ->get();
            return $lotes;
          } else {
            $lotes = Recepcion_MP::select("recepcion_mp.*", "rmd.nro_lote")
              ->leftJoin("recepcion_mp_detalles as rmd", "rmd.recepcion_id", "=", "recepcion_mp.id")
              ->where(["proveedor_id" => $proveedor_id])
              ->whereRaw("nro_lote IS NOT NULL")
              ->get();
              return $lotes;
          }
        } else {
          return [];
        }
      } else {
        return [];
      }
    } 
    public function detalleStock($lote){
      $detalle = DetalleCompra::where("nro_lote",$lote)
                                ->first();
      return array(
        "peso_bruto" => $detalle->peso_bruto,
        "peso_tara" => $detalle->peso_tara
      );
    }

    public function liquidar (Request $request){
       $lotes = $request->lotes;
       $accesorios = $request->accesorios;
       //dd($lotes, $accesorios);
       //dd($request->all());
       if ($lotes) {
         foreach ($lotes as $key => $lote) {

           $detalle = Resumen_Stock_MP::where("lote",$lote[0])
                                    ->first();

           $compra = Compra::find($detalle->compra_id);
           $movimiento = array(
             "fecha" => date("Y-m-d"),
             "compra_id"=> 0,
             "proveedor_id"=>$detalle->proveedor_id,
             "lote" => $lote[0],
             "titulo_id" => 0,
             "cantidad"=>(-($lote[1])),
             "peso_neto"=>(-$detalle->peso_neto),
             "estado"=>1
           );

           $movimiento["insumo_id"] = $detalle->insumo_id;
           $movimiento["accesorio_id"] =  0;
           $movimiento["descripcion"] = "Liquidacion";

           Movimiento_MP::create($movimiento);
           $detalle["cantidad"] = 0;
           $detalle["peso_neto"] = 0;
           $detalle->delete();
         }

       }

       if ($accesorios) {
         foreach ($accesorios as $key => $accesorios) {

           $detalle = Resumen_Stock_MP::where("accesorio_id",$accesorios[0])
                                    ->first();

           $compra = Compra::find($detalle->compra_id);
           $movimiento = array(
             "fecha" => date("Y-m-d"),
             "compra_id"=> 0,
             "proveedor_id"=>$detalle->proveedor_id,
             "lote" => 0,
             "titulo_id" => 0,
             "cantidad"=>(-($accesorios[1])),
             "peso_neto"=>(-$detalle->peso_neto),
             "estado"=>1
           );

           $movimiento["insumo_id"] = 0;
           $movimiento["accesorio_id"] =  $detalle->accesorio_id;
           $movimiento["descripcion"] = "Liquidacion";

           Movimiento_MP::create($movimiento);
           $detalle["cantidad"] = 0;
           $detalle["peso_neto"] = 0;
           $detalle->delete();
         }
       }
    }

    public function liquidacion(Request $request){

        $proveedores = Proveedor::all();
        $insumos = Insumo::all();
        $accesorios = Accesorio::all();
        $marcas = Marca::all();
        $titulos = Titulo::all();

        // ->join('insumos', 'resumen_stock_materiaprima.insumo_id', '=', 'insumos.id')
        // ->join('accesorios', 'resumen_stock_materiaprima.accesorio_id', '=', 'accesorios.id')
        // ->select('resumen_stock_materiaprima.lote','accesorios.nombre as nombre_accesorio','insumos.nombre_generico as nombre_insumo','cantidad')

        // $compras = DB::table('resumen_stock_materiaprima')
        // ->select('lote','accesorio_id','insumo_id')
        // ->get();
        // //dd($compras);
        // foreach ($compras as $key => $compra) {
        //   if ($compra->insumo_id==0) {
        //     $compra->materia_prima=Accesorio::select('nombre')
        //     ->where('id',$compra->accesorio_id)
        //     ->first();
        //   }
        //   else {
        //     $compra->materia_prima=Insumo::select('nombre_generico as nombre')
        //     ->where('id',$compra->insumo_id)->first();
        //   }
        // }

        if ($request->ajax()) {
        //$compras = Compra::with('insumos','accesorios');
        $resumen = Resumen_Stock_MP::with('accesorio','insumo', 'titulo', 'proveedor');
        //dd($resumen);
        // foreach ($compras as $key => $compra) {
        //   foreach ($compra->detalles as $key => $detalle) {
        //     $detalle->stock = Resumen_Stock_MP::where("materiaprima_id",$detalle["insumo_id"])
        //     ->where("proveedor_id",$detalle["proveedor_id"])
        //     ->groupBy("created_at","DESC")
        //     ->first()
        //     ->cantidad;
        //   }
        // }
        //

        return Datatables::eloquent($resumen)
                          ->filter(function ($query) use ($request) {


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


                          })
                          ->make(true);
        }
        //dd($compras);
        return view('liquidacion-lotes.index',compact('proveedores','insumos','accesorios','marcas','titulos'));
    }

    public function existeLote(Request $request)
    {
        $requestData = $request->all();

        $detallesCompra = DetalleCompra::where('nro_lote', $requestData['lote'])
                                ->orderBy('created_at','DESC')
                                ->first();
        $compra = Compra::where("id",$detallesCompra["compra_id"])
                          ->where("proveedor_id", $requestData["proveedor"])
                          ->whereNull("deleted_at")
                          ->count();

        header('Content-Type: application/json');
        if ($compra == 0)
            echo json_encode(array('resultado' => false));
        else
            echo json_encode(array('resultado' => true));
    }

    public function recepcion(Request $request){

        if ($request->ajax()) {
        $compras = Compra::with('proveedor','detalles','detalles.insumo','detalles.titulo');
        return Datatables::eloquent($compras)
                          ->filter(function ($query) use ($request) {


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


                          })
                          ->make(true);
        }

        $proveedores = Proveedor::all();
        $insumos = Insumo::all();
        $accesorios = Accesorio::all();
        $marcas = Marca::all();
        $titulos = Titulo::all();

        return view('materia-prima.recepcion',compact('proveedores','insumos','accesorios','marcas','titulos'));
    }

    public function recepcionar(Request $request){
      $requestData = $request->all();

      $this->validate($request, [
          'fecha'             => 'date',
          'tipo_comprobante'  => 'required',
          'detalles'          => 'required',
      ]);


      foreach ($requestData["detalles"] as $key => $detalle) {
        $movimiento = array(
          "fecha" => "" ,
          "compra_id"=>$detalle->id,
          "proveedor_id"=>$detalle["proveedor_id"],
          "lote" => $detalle["nro_lote"],
          "materiaprima_id" => $detalle["insumo_id"],
          "titulo_id" => $detalle["titulo"],
          "cantidad"=>(-($detalle["peso_bruto"]-$detalle["peso_tara"])),
          "estado"=>1
        );

        Movimiento_MP::create($movimiento);
        Resumen_Stock_MP::calculateCurrentStock($detalle["nro_lote"],$detalle["insumo_id"],$requestData["proveedor_id"],$detalle["peso_neto"], $detalle["titulo"]);


      }

    }

    public function mp_stock($lote){
      return Resumen_Stock_MP::where("lote",$lote)
                 ->orderBy("created_at","DESC")
                 ->first()
                 ->cantidad;
    }
    public function insumo_stock($insumo_id,$proveedor_id){

      return Resumen_Stock_MP::where("accesorio_id",$insumo_id)
                 ->orderBy("created_at","DESC")
                 ->first()
                 ->cantidad;
    }

    public function cronograma($compra_id='')
    {
        echo $compra_id;
    }

    public function getPdf(Request $request)
    {
      $pdf = App::make('dompdf.wrapper');
      $html = "";
      $compra = Compra::find($request->id);
      $totalpeso = 0;
      $totalcantidad = 0;
      if (!is_null($compra)) {
        $detalles = DetalleCompra::where(["compra_id" => $compra->id])
          ->with("insumo", "accesorio", "titulo")->get();
          //dd($detalles);
        $proveedor = Proveedor::find($compra->proveedor_id);
        $procedencia = Procedencia::find($compra->procedencia_id);
        $html.="<div style='font-family: Helvetica, font-size:11px'>";
        $html.="<p><b>Fecha: </b>".date('Y-m-d', strtotime($compra->fecha))."</p>";
        $html.="<h1>Nota de Ingreso - ".leadZero($compra->codigo)."</h1>";
        $html.="<p><b>Proveedor: </b>".$proveedor->nombre_comercial."</p>";
        $html.="<p><b>Procedencia: </b>".$procedencia->nombre."</p>";
        $html.="<p><b># Comprobante: </b>".$compra->nro_comprobante."</p>";
        $html.="<p><b># Guía: </b>".$compra->nro_guia."</p>";

          $html.="<div>";
              $html.="<table>";
                $html.="<thead>";
                  $html.="<tr>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 50px; padding:5px;'>Item</th>";
                  //$html.="<th style='text-align:center; border: solid 1px; width: 100px; padding:5px;'>Código</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 200px; padding:5px;'>Descripcion</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 100px; padding:5px;'>Título</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 100px; padding:5px;'>Lote</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 120px; padding:5px;'>Cajas/Bolsas</th>";
                  $html.="<th style='text-align:center; border: solid 1px; width: 80px; padding:5px;'>Peso</th>";
                  $html.="</tr>";
                $html.="</thead>";

                $html.="<tbody>";
                $i = 1;
                  foreach ($detalles as $key => $value) {
                    $html.="<tr>";
                    $html.="<td style='text-align:center; padding:5px;'>$i</td>";
                    //dd($value->insumo->nombre_generico);
                    if (!is_null($value->insumo)) {
                      //$html.="<td style='text-align:center; padding:5px;'>".$value->insumo->nombre_generico."</td>";
                      $html.="<td style='text-align:center; padding:5px;'>".$value->insumo->nombre_especifico."</td>";
                    }
                    if (!is_null($value->accesorio)) {
                      $html.="<td style='text-align:center; padding:5px;'>".$value->accesorio->nombre."</td>";
                      //$html.="<td style='text-align:center; padding:5px;'></td>";
                    }
                    if (!is_null($value->titulo)) {
                      $html.="<td style='text-align:center; padding:5px;'>".$value->titulo->nombre."</td>";
                    } else {
                      $html.="<td style='text-align:center; padding:5px;'></td>";
                    }
                    $html.="<td style='text-align:center; padding:5px;'>".$value->nro_lote."</td>";
                    $pesobruto = 0;
                    $pesotara = 0;
                    $html.="<td style='text-align:center; padding:5px;'>".$value->cantidad."</td>";
                    $totalcantidad+=$value->cantidad;
                    if (!is_null($value->peso_bruto)) {
                      $pesobruto = $value->peso_bruto;
                    }

                    if (!is_null($value->peso_tara)) {
                      $pesotara = $value->peso_tara;
                    }

                    $pesoneto = $pesobruto - $pesotara;
                    //dd($pesoneto);
                    $totalpeso+=$pesoneto;
                    $html.="<td style='text-align:center; padding:5px;'>".number_format($pesoneto, 2)."</td>";

                    $html.="</tr>";
                    $i++;
                  }
                $html.="<tr>";
                //$html.="<td style='text-align:center; padding:5px;'></td>";
                $html.="<td style='text-align:center; padding:5px;'></td>";
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
      //$pdf->loadHTML($html);
      return $pdf->stream();
    }
}
