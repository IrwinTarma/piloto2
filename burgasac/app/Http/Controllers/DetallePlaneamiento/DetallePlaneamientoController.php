<?php

namespace App\Http\Controllers\DetallePlaneamiento;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\DetallePlaneamiento;
use App\Planeamiento;
use App\Proveedor;
use App\Accesorio;
use App\Empleado;
use App\Maquina;
use App\Producto;
use App\Insumo;
use App\Titulo;

class DetallePlaneamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $proveedores = Proveedor::all();
        $accesorios = Accesorio::all();
        $empleados = Empleado::all();
        $maquinas = Maquina::all();
        $productos = Producto::all();
        $insumos = Insumo::all();
        $titulos = Titulo::all();
        $detallePlaneamiento = DetallePlaneamiento::find($id);
        $planeamiento = Planeamiento::find($detallePlaneamiento->planeamiento_id);
        return view('detalle-planeamiento.edit',compact('detallePlaneamiento','planeamiento','accesorios','empleados','proveedores','maquinas','productos','insumos','titulos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function materia(Request $request, $id){
      $detalle = DetallePlaneamiento::find($id);
      $detalle->cajas = $request->caja;
      $detalle->Kg = $request->materia;
      $detalle->save();
    }
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $requestData["accesorio_id"] = $requestData["accesorio"];
        $requestData["insumo_id"] = $requestData["insumo"];
        $requestData["maquina_id"] = $requestData["maquina"];
        $detalle = DetallePlaneamiento::find($id);
        $detalle->update($requestData);

        return redirect('/bandeja-produccion/bandeja-produccion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle = DetallePlaneamiento::find($id);
        $detalle->delete();
    }
}
