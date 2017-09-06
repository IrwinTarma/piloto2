<?php

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tienda;
use DB;


class NotaIngresoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
/*
    public function index()
    {
    	$provedors=provedor::orderBy("nProvCod","ASC")->paginate();
    	return view("provedor.index",compact("provedors"));
    }

    public function store(Request $request)
    {
    	$provedor=new provedor;
        $provedor->nProvRuc=$request->ruc;
        $provedor->cProvNom=$request->nombre;
        $provedor->cProvDir=$request->dir;
        $provedor->cProvTel=$request->tel;
        $provedor->cProvCel=$request->cel;            
        $provedor->cProvEma=$request->email;
        $provedor->cProvObs=$request->obs;
        
        $provedor->save();

        return redirect()->route('provedor.index')->with('info','El proveedor fue creado.');  
    }

    public function update(Request $request,$id)
    {
        $provedor=provedor::find($id);
        $provedor->nProvRuc=$request->ruc;
        $provedor->cProvNom=$request->nombre;
        $provedor->cProvDir=$request->dir;
        $provedor->cProvTel=$request->tel;
        $provedor->cProvCel=$request->cel;            
        $provedor->cProvEma=$request->email;
        $provedor->cProvObs=$request->obs;
        
        $provedor->save();

        return redirect()->route('provedor.show',$id)->with('info','El proveedor fue actualizado.');  
    }

    public function show($id)
    {
    	$provedor=provedor::where('nProvCod','=',$id)->get();
    	return view("provedor.show",compact("provedor"));
    }

    public function edit($id)
    {
    	$provedor=provedor::where('nProvCod','=',$id)->get();
    	return view("provedor.edit",compact("provedor"));
    }

    public function destroy($id)
    {
        $provedor=provedor::where('nProvCod','=',$id);
        $provedor->delete();
        return back()->with('info','El proveedor fue eliminado.');
    }
*/
    public function create($id)
    {
   		$bandeja = DB::table('detalles_despacho_tintoreria')
            ->leftJoin('color', 'detalles_despacho_tintoreria.color_id', '=', 'color.id')
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
            ->where('detalles_despacho_tintoreria.id','like', '%'.$id.'%')        
            ->get();

    	return view("comercializacion.notaingreso.create",compact('bandeja'));
    }
  
}
