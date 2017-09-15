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
use App\Color;
use Carbon\Carbon;
use Session;
use App\DetallePlaneamiento;
use Yajra\Datatables\Facades\Datatables;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class ComercializacionController extends Controller
{
    public function index(request $request)
    {
        $proveedores = Proveedor::all();
        $empleados = Empleado::all();
        $productos = Producto::all();

        $bandeja = DB::table('detalles_despacho_tintoreria')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id_color')
            ->leftJoin('productos', 'detalles_despacho_tintoreria.producto_id', '=', 'productos.id')
            ->leftJoin('proveedores', 'detalles_despacho_tintoreria.proveedor_id', '=', 'proveedores.id')
            ->select('detalles_despacho_tintoreria.created_at',
                'detalles_despacho_tintoreria.id', 
                'proveedores.razon_social', 
                'productos.nombre_generico',
                'detalles_despacho_tintoreria.cantidad',
                'detalles_despacho_tintoreria.rollos',
                'color.nombre',
                'detalles_despacho_tintoreria.estado',
                'detalles_despacho_tintoreria.color_id',
                'detalles_despacho_tintoreria.producto_id',
                'detalles_despacho_tintoreria.proveedor_id',
                'detalles_despacho_tintoreria.nro_lote')
            ->where('detalles_despacho_tintoreria.created_at', 'like', '%'.$request->fecha.'%')
            ->where('detalles_despacho_tintoreria.id','like', '%'.$request->control.'%')
            ->where('detalles_despacho_tintoreria.proveedor_id','like', '%'.$request->proveedor.'%')
            ->where('detalles_despacho_tintoreria.producto_id','like', '%'.$request->producto.'%')
            ->where('detalles_despacho_tintoreria.estado','like', '%'.$request->estado.'%')
            ->paginate(10);

        $datosant=$request;

        return view('comercializacion.index',
            compact('proveedores','empleados','productos','bandeja','datosant'));

    }

    public function update(Request $request,$id)
    {
        $ddt=DetalleDespachoTintoreria::find($id);
        $ddt->estado=1;                
        $ddt->save();

        return redirect()->route('comercializacion.index')->with('info','El detalle fue cerrado.');  
    }
}


/*if ($request->ajax()) {
    $requestData = $request->all();
    //$planeamientos = Planeamiento::with('empleado','maquina','detalles.accesorio','detalles.titulo','detalles.insumo','proveedor','producto');
    $DetalleDespachoTintorerias = DetalleDespachoTintoreria::with('despachotintoreria','color','proveedor','producto');          
    return Datatables::eloquent($DetalleDespachoTintorerias)
        ->filter(function ($query) use ($request) {
           
            if ($request->has('control')){
                $query->where('despacho_id', '=', $request->control);
            }
            if ($request->has('proveedor')) {
                $query->where('proveedor_id', '=', $request->proveedor);
            }

            if($request->has('producto')){
                $query->where("producto_id","=",$request->producto);
            }
        })
        ->make(true);
}*/