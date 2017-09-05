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
use App\Producto;
use Carbon\Carbon;
use Session;
use App\DetallePlaneamiento;
use Yajra\Datatables\Facades\Datatables;
use DB;

class BandejaProduccionController extends Controller
{
    public function index(Request $request){
        $proveedores = Proveedor::all();
        $empleados = Empleado::all();

              if($request->ajax()){
                $requestData = $request->all();
                $planeamientos = Planeamiento::with('empleado','maquina','accesorio','detalles.titulo','detalles.insumo','proveedor','producto')->get();
                //dd('as');
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
                                      }


                                })
                                ->make(true);

              }
        return view('planeamientos.bandeja.index',compact('proveedores','empleados'));

    }
}
