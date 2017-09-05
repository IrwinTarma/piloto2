<?php

namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use App\Proveedor;
use App\Producto;
use App\Insumo;
use App\Accesorio;
use App\Empleado;
use App\Compra;
use App\Maquina;
use App\Planeamiento;
use App\Resumen_Stock_MP;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Excel;
use App\Resumen_Stock_Tela;
use App\ResumenDespachoTintoreria;
use App\ProveedorDespachoTintoreriaDeuda;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        $accesorios = Accesorio::all();
        $insumos = Insumo::all();
        $empleados = Empleado::all();
        $maquinas = Maquina::all();
        return view('reportes.index',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));
    }

    public function proveedorTintoreriaDeuda()
    {
        $deudas = ProveedorDespachoTintoreriaDeuda::with('proveedor', 'color', 'producto')->get();
        return view('reportes.proveedor_tela_deuda', compact('deudas'));
    }

    public function compras(Request $request){

      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
        $requestData = $request->all();
        $compras = Compra::with('proveedor','procedencia','detalles','detalles.titulo','detalles.insumo','detalles.accesorio');

        return Datatables::eloquent($compras)
                        ->filter(function ($query) use ($request) {

                              if ($request->has('date')){
                                $query->whereDate('fecha', '=', $request->date);
                              }

                              if ($request->has('proveedor')) {
                                $query->where('proveedor_id', '=', $request->proveedor);
                              }
                              if ($request->has('accesorio')) {
                                $query->whereHas('detalles', function($query) use ($request){
                                    $query->where('detalle_compras.accesorio_id', '=', $request->accesorio);
                                });
                              }

                              if ($request->has('insumo')) {
                                $query->whereHas('detalles', function($query) use ($request){
                                    $query->where('detalle_compras.insumo_id', '=', $request->insumo);
                                });
                              }
                        })
                        ->make(true);        
      }

      return view('reportes.compras',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function stockGeneral(Request $request){

      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
        $resumenes = Resumen_Stock_MP::with('insumo','accesorio', 'proveedor', 'titulo');
        return Datatables::eloquent($resumenes)
                        ->filter(function ($query) use ($request) {

                              if ($request->has('accesorio')) {
                                $query->where('accesorio_id', '=', $request->accesorio);
                              }

                              if ($request->has('insumo')) {
                                $query->where('insumo_id', '=', $request->insumo);
                              }

                        })
                        ->make(true);        
      }

      return view('reportes.stock_general.index',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));


    }

     public function despachoTintoreria(Request $request){
      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
        $telas = ResumenDespachoTintoreria::select("resumen_despacho_tintoreria.*", "p.nombre_generico as producto", "c.nombre as color")
          ->leftJoin("productos as p", "p.id", "=", "resumen_despacho_tintoreria.producto_id")
          ->leftJoin("color as c", "c.id", "=", "resumen_despacho_tintoreria.color_id")
          ->orderBy("resumen_despacho_tintoreria.id", "DESC");
        return Datatables::eloquent($telas)
                    ->make(true);
      }

      return view('reportes.despacho_tintoreria',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));

    }

    public function telasResumen(Request $request){
      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
        $telas = Resumen_Stock_Tela::with('producto', 'proveedor');
        return Datatables::eloquent($telas)
                    ->filter(function ($query) use ($request) {
                          if ($request->has('producto')) {
                            $query->where('producto_id', '=', $request->producto);
                          }
                    })
                    ->make(true);
      }

      return view('reportes.telas',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));

    }

    public function telasDescargar(Request $request){

      $producto = $request->producto;

      $resumen_stock = DB::table("resumen_stock_telas")
                          ->join("productos","productos.id","=","resumen_stock_telas.producto_id");

      if($producto) $resumen_stock->where("producto_id",$producto);

      $resumenes =  $resumen_stock->select('productos.nombre_generico as Producto', 'resumen_stock_telas.nro_lote as Lote', 'rollos as Rollos',DB::raw("cantidad as 'Peso Neto(KG)'"))->get();
       $resumenes_array = array();
       foreach ($resumenes as $key => $resumen) {
         $resumenes_array[] = (array)$resumen;
       }
       Excel::create('Reporte_stock_telas_'.date('Ymdhis'), function($excel) use($resumenes_array) {
           $excel->sheet('Sheetname', function($sheet) use($resumenes_array) {

               $sheet->setAllBorders('thin');
               $sheet->mergeCells('A1:O1');
               $sheet->row(1, array(
                'Reporte de stock telas'
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

               $sheet->fromArray($resumenes_array, null, 'A3', false, true);
           });

       })->export('xls');

    }

    public function produccionResumen(Request $request){
      
      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
      $planeamientos = Planeamiento::with('empleado','maquina','detalles.accesorio','detalles.titulo','detalles.insumo','proveedor','producto');
      return Datatables::eloquent($planeamientos)
                      ->filter(function ($query) use ($request) {


                            $q = $request->search["value"];
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

      return view('reportes.produccion',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));

    }

    public function produccionDescargar(Request $request){

            $producto = $request->producto;
            $maquina = $request->maquina;
            $proveedor = $request->proveedor;
            $empleado = $request->empleado;
            $fecha = $request->fecha;




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

            $planeamientos_query->select('planeamientos.fecha as Fecha','proveedores.nombre_comercial as Proveedor',DB::raw("CONCAT(empleados.nombres,' ',empleados.apellidos) as Tejedor"),'planeamientos.turno as Turno','maquinas.nombre as Maquina','productos.nombre_generico as Producto' , DB::raw('CASE WHEN accesorio_id = 0
                       THEN insumos.nombre_generico
                    ELSE accesorios.nombre
               END as "Insumo/Accesorio"'), 'detalle_planeamientos.cantidad as Bolsas/Paquetes', DB::raw("detalle_planeamientos.kg as 'Peso Neto (KG)'") );

            $planeamientos = $planeamientos_query->get();

            // $planeamientos = DB::select(DB::raw("SELECT p.fecha 'Fecha', pr.nombre_comercial 'Proveedor', CONCAT(e.nombres,' ',e.apellidos) 'Colaborador', p.turno 'Turno',m.nombre 'Maquina',prd.nombre_generico 'Producto', dp.lote_insumo 'Lote',i.nombre_generico 'MP', t.nombre 'Titulo',dp.cajas 'Cajas', dp.Kg 'Kg', p.rollos 'Rollos',p.kg_producidos 'Kg Pr', p.kg_falla 'Falla Kg' FROM planeamientos p INNER JOIN detalle_planeamientos dp ON p.id = dp.planeamiento_id INNER JOIN empleados e ON e.id = p.empleado_id INNER JOIN maquinas m ON m.id = p.maquina_id LEFT JOIN accesorios a ON a.id = dp.accesorio_id INNER JOIN titulos t ON t.id = dp.titulo_id LEFT JOIN insumos i ON i.id = dp.insumo_id INNER JOIN proveedores pr ON pr.id = p.proveedor_id INNER JOIN productos prd ON prd.id = p.producto_id"));

            $objPlaneamientos = $planeamientos;
            $planeamientos = array();
            foreach ($objPlaneamientos as $objPlaneamiento) {
              $planeamientos[] = (array)$objPlaneamiento;
            }


            Excel::create('Reporte de produccion', function($excel) use($planeamientos) {
                $excel->sheet('Sheetname', function($sheet) use($planeamientos) {
                    $sheet->setAllBorders('thin');
                    $sheet->mergeCells('A1:O1');
                    $sheet->row(1, array(
                     'Reporte de produccion'
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

    public function planeamientosResumen(Request $request){

      $proveedores = Proveedor::all();
      $productos = Producto::all();
      $accesorios = Accesorio::all();
      $insumos = Insumo::all();
      $empleados = Empleado::all();
      $maquinas = Maquina::all();

      if($request->ajax()){
      $planeamientos = Planeamiento::with('empleado','maquina','proveedor','producto');
      return Datatables::eloquent($planeamientos)
                      ->filter(function ($query) use ($request) {


                            $q = $request->search["value"];
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
      return view('reportes.planeamientos',compact('proveedores','productos','accesorios','insumos','empleados','maquinas'));


    }

    public function planeamientosDescargar(Request $request){
      // SELECT p.fecha 'Fecha', pr.nombre_comercial 'Proveedor', CONCAT(e.nombres,' ',e.apellidos) 'Colaborador', p.turno 'Turno',m.nombre 'Maquina',prd.nombre_generico 'Producto', dp.lote_insumo 'Lote',i.nombre_generico 'MP', t.nombre 'Titulo',dp.cajas 'Cajas', dp.Kg 'Kg', p.rollos 'Rollos',p.kg_producidos 'Kg Pr', p.kg_falla 'Falla Kg' FROM planeamientos p INNER JOIN detalle_planeamientos dp ON p.id = dp.planeamiento_id INNER JOIN empleados e ON e.id = p.empleado_id INNER JOIN maquinas m ON m.id = p.maquina_id LEFT JOIN accesorios a ON a.id = dp.accesorio_id INNER JOIN titulos t ON t.id = dp.titulo_id LEFT JOIN insumos i ON i.id = dp.insumo_id INNER JOIN proveedores pr ON pr.id = p.proveedor_id INNER JOIN productos prd ON prd.id = p.producto_id

      $producto = $request->producto;
      $maquina = $request->maquina;
      $proveedor = $request->proveedor;
      $empleado = $request->empleado;
      $fecha = $request->fecha;

      $planeamientos_query = DB::table("planeamientos")
          ->join("empleados","planeamientos.empleado_id","=","empleados.id")
          ->join("maquinas","planeamientos.maquina_id","=","maquinas.id")
          ->join("proveedores","planeamientos.proveedor_id","=","proveedores.id")
          ->join("productos","productos.id","=","planeamientos.producto_id");

      if($fecha) $planeamientos_query->where("fecha","=",$fecha);
      if($producto) $planeamientos_query->where("producto_id","=",$producto);
      if($maquina) $planeamientos_query->where("maquina_id","=",$maquina);
      if($proveedor) $planeamientos_query->where("proveedor_id","=",$proveedor);
      if($empleado) $planeamientos_query->where("empleado_id","=",$empleado);

      $planeamientos_query->select('fecha as Fecha','proveedores.nombre_comercial as Proveedor',DB::raw("CONCAT(empleados.nombres,' ',empleados.apellidos) as Tejedor"),'planeamientos.turno as Turno','maquinas.nombre as Maquina','productos.nombre_generico as Producto');
      $planeamientos = $planeamientos_query->get();
      $objPlaneamientos = $planeamientos;
      //$planeamientos = DB::select(DB::raw("SELECT p.fecha 'Fecha', pr.nombre_comercial 'Proveedor', CONCAT(e.nombres,' ',e.apellidos) 'Tejedor', p.turno 'Turno',m.nombre 'Maquina',prd.nombre_generico 'Producto' FROM planeamientos p INNER JOIN empleados e ON e.id = p.empleado_id INNER JOIN maquinas m ON m.id = p.maquina_id INNER JOIN proveedores pr ON pr.id = p.proveedor_id INNER JOIN productos prd ON prd.id = p.producto_id "));
      $planeamientos = array();
      foreach ($objPlaneamientos as $objPlaneamiento) {
        $planeamientos[] = (array)$objPlaneamiento;
      }


      Excel::create('Reporte de planeamientos', function($excel) use($planeamientos) {
          $excel->sheet('Sheetname', function($sheet) use($planeamientos) {
              $sheet->setAllBorders('thin');
              $sheet->mergeCells('A1:F1');
              $sheet->row(1, array(
               'Reporte de planeamientos'
              ));

              $sheet->cell('A1', function($cell) {
                  $cell->setFont(array(
                      'family'     => 'Calibri',
                      'size'       => '16',
                      'bold'       =>  true
                  ));
                  $cell->setAlignment('center');

              });

              $sheet->cell('A3:F3', function($cells) {
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

    public function resumenDescargar(Request $request){
      $insumo = $request->insumo;
      $accesorio = $request->accesorio;

      $resumen_stock = DB::table("resumen_stock_materiaprima")
                          ->join("proveedores","proveedores.id","=","resumen_stock_materiaprima.proveedor_id")
                          ->leftJoin("insumos","insumos.id","=","resumen_stock_materiaprima.insumo_id")
                          ->leftJoin("accesorios","accesorios.id","=","resumen_stock_materiaprima.accesorio_id");

      if($insumo) $resumen_stock->where("insumo_id",$insumo);
      if($accesorio) $resumen_stock->where("accesorio_id",$accesorio);

      $resumenes =  $resumen_stock->select('lote as Lote',DB::raw('CASE WHEN accesorio_id = 0
                 THEN insumos.nombre_generico
              ELSE accesorios.nombre
         END as Producto'),'cantidad as Cantidad/Bolsas',DB::raw("peso_neto as 'Peso Neto(KG)'"))->get();
       $resumenes_array = array();
       foreach ($resumenes as $key => $resumen) {
         $resumenes_array[] = (array)$resumen;
       }
       Excel::create('Reporte de stock general mp', function($excel) use($resumenes_array) {
           $excel->sheet('Sheetname', function($sheet) use($resumenes_array) {
             $sheet->setAllBorders('thin');
             $sheet->mergeCells('A1:O1');
             $sheet->row(1, array(
              'Reporte de stock general mp'
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

             $sheet->fromArray($resumenes_array, null, 'A3', false, true);

           });

       })->export('xls');

    }

    public function comprasDescargar(Request $request){

      $date = $request->date;
      $proveedor = $request->proveedor;
      $accesorio = $request->accesorio;
      $insumo = $request->insumo;
      $compras_query = DB::table("compras")
          ->join("detalle_compras","detalle_compras.compra_id","=","compras.id")
          ->join("proveedores","proveedores.id","=","compras.proveedor_id")
          ->join("procedencias","procedencias.id","=","compras.procedencia_id")
          ->join("titulos","titulos.id","=","detalle_compras.titulo_id")
          ->leftJoin("insumos","insumos.id","=","detalle_compras.insumo_id")
          ->leftJoin("accesorios","accesorios.id","=","detalle_compras.accesorio_id");


      if($date) $compras_query->whereDate("fecha",$date);
      if($proveedor) $compras_query->where("compras.proveedor_id",$proveedor);
      if($accesorio) $compras_query->where("detalle_compras.accesorio_id",$accesorio);
      if($insumo) $compras_query->where("detalle_compras.insumo_id",$insumo);

      $compras = $compras_query->select('fecha as Fecha','nombre_comercial as Proveedor','procedencias.nombre as Procedencia','compras.codigo as Cod.compra','compras.nro_guia as Guia','compras.nro_comprobante as Nª Factura','nro_lote as Lote',
                DB::raw('CASE WHEN detalle_compras.accesorio_id = 0
                           THEN insumos.nombre_generico
                        ELSE accesorios.nombre
                   END as Producto'),'titulos.nombre as Titulo/Codigo','detalle_compras.cantidad as Cantidad',DB::raw('(detalle_compras.peso_bruto - detalle_compras.peso_tara) as "Peso Neto"'))->get();
      $array_compras = array();
      foreach ($compras as $key => &$compra) {
        $array_compras[] = (array)$compra;
      }

      Excel::create('Reporte de compras', function($excel) use($array_compras) {
          $excel->sheet('Sheetname', function($sheet) use($array_compras) {
            $sheet->setAllBorders('thin');
            $sheet->mergeCells('A1:O1');
            $sheet->row(1, array(
             'Reporte de compras'
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

            $sheet->fromArray($array_compras, null, 'A3', false, true);

          });

      })->export('xls');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
