<?php

namespace App\Http\Controllers\Comercializacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class NotaIngresoAController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view("comercializacion.notaingresoatipico.create");

    }
/*

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
    public function create()
    {
    	return view("comercializacion.notaingresoatipico.create");
    }
  
}
