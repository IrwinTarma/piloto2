<?php

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Planeamiento;
use App\DetalleDespachoTintoreria;
use App\DespachoTintoreria;
use App\Proveedor;
use App\Insumo;
use App\Accesorio;
use App\Marca;
use App\Titulo;
use App\Empleado;
use App\Maquina;
use App\Producto;
use Carbon\Carbon;
use Session;
use App\DetallePlaneamiento;
use Yajra\Datatables\Facades\Datatables;
use DB;

class ComercializacionController extends Controller
{
    public function index(Request $request)
    {
        $proveedores = Proveedor::all();
        $empleados = Empleado::all();

        if ($request->ajax()) {
            $requestData = $request->all();
            //$planeamientos = Planeamiento::with('empleado','maquina','detalles.accesorio','detalles.titulo','detalles.insumo','proveedor','producto');
            $DetalleDespachoTintorerias = DetalleDespachoTintoreria::with('despachotintoreria','color','proveedor','producto');

            //dd($planeamientos);
            return Datatables::eloquent($DetalleDespachoTintorerias)
                ->filter(function ($query) use ($request) {
                    /*
                                        if ($request->has('fecha')){
                                           $query->where('despachotintoreria.fecha', '=', $uest->fecha);
                                        }
                                    if ($request->has('fecha')) {
                                            $query->whereHas('despachotintoreria', function($query) use ($request){
                                                $query->where('despachotintoreria.fecha', '=', $request->fecha);
                                            });
                                        }
                    */
                    if ($request->has('control')){
                        $query->where('despacho_id', '=', $request->control);
                    }
                    if ($request->has('proveedor')) {
                        $query->where('proveedor_id', '=', $request->proveedor);
                    }

                    if($request->has('producto')){
                        $query->where("producto_id","=",$request->producto);
                    }
/*
                    if($request->has('maquina')){
                        $query->where("maquina_id","=",$request->maquina);
                    }
                    if ($request->has('empleado')) {
                        $query->where('empleado_id', '=', $request->empleado);
                    }

                    if ($request->has('estado')){
                        $query->where('estado', '=', $request->estado);
                    }

                    if ($request->has('turno')) {
                        $query->where('turno', '=', $request->turno);
                    }




*/
///////////////
                    /*
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
                    }*/
                })
                ->make(true);
        }
        $productos = Producto::all();
        return view('comercializacion.index',compact('proveedores','empleados','productos'));

    }
}
