<?php

namespace App\Http\Controllers\Producto;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Producto;
use App\Indicador;
use App\Insumo;
use App\Titulo;
use Illuminate\Http\Request;
use Session;
use DB;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $producto = Producto::paginate(25);

        return view('producto.index', compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $insumos = Insumo::select(
                "insumos.*", 
                DB::raw("(CONCAT(insumos.nombre_generico, ' ', t.nombre)) as nombre_insumo"),
                "t.nombre as titulo"
            )
            ->leftJoin("titulos as t", "t.id", "=", "insumos.titulo_id")
            ->whereRaw("insumos.deleted_at IS NULL")
            ->get();

        return view('producto.create', compact('insumos'));
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

        $requestData = $request->all();
        //dd($requestData);
        $this->validate($request, [
            'nombre_generico'       => 'required',
        ]);

        Producto::create($requestData);
        $id = Producto::orderBy('created_at', 'desc')->select('id')->first();
        //dd($requestData['detalles']);
        foreach ($requestData['detalles'] as $key => $detalle) {
          //dd($id->id);

          $indicador['producto_id'] = $id->id;
          //dd($detalle);
          $indicador['insumo_id'] = $detalle['insumo_id'];
          $insumo = Insumo::find($detalle["insumo_id"]);
          if (!is_null($insumo)) {
            $titulo = Titulo::find($insumo->titulo_id);
              if (!is_null($titulo)) {
                $indicador['titulo_id'] = $titulo->id;
              } else {
                    $indicador['titulo_id'] = 0;
              }
          } else {
            $indicador['titulo_id'] = 0;
          }
          

          $indicador['valor'] = $detalle['cantidad'];
          Indicador::create($indicador);
        }

        Session::flash('flash_message', 'Producto added!');

        return redirect('producto/productos');
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
        $producto = Producto::findOrFail($id);

        return view('producto.show', compact('producto'));
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
        $producto = Producto::findOrFail($id);
        $insumos = Insumo::select(
                "insumos.*", 
                DB::raw("(CONCAT(insumos.nombre_generico, ' ', t.nombre)) as nombre_insumo"),
                "t.nombre as titulo"
            )
            ->leftJoin("titulos as t", "t.id", "=", "insumos.titulo_id")
            ->whereRaw("insumos.deleted_at IS NULL")
            ->get();

        $indicadores = Indicador::where("producto_id",$id)
                                ->with("insumo", "titulo")
                                ->get();
        
        return view('producto.edit', compact('producto','insumos','indicadores'));
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

        $requestData = $request->all();
        $detalles = $requestData["detalles"];
        $producto = Producto::findOrFail($id);
        $producto->update($requestData);
        $indicadores = Indicador::where("producto_id",$id)->delete();

        foreach ($detalles as $key => $detalle) {
          $indicador = new Indicador();
          $indicador->producto_id = $id;
          $indicador->insumo_id = $detalle["insumo_id"];
          $insumo = Insumo::find($detalle["insumo_id"]);
          if (!is_null($insumo)) {
            $titulo = Titulo::find($insumo->titulo_id);
              if (!is_null($titulo)) {
                $indicador['titulo_id'] = $titulo->id;
              } else {
                    $indicador['titulo_id'] = 0;
              }
          } else {
            $indicador['titulo_id'] = 0;
          }
          
          $indicador->valor = $detalle["cantidad"];
          $indicador->save();
        }

        Session::flash('flash_message', 'Producto updated!');

        return redirect('producto/productos');
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
        Producto::destroy($id);
        Indicador::where("producto_id",$id)->delete();

        Session::flash('flash_message', 'Producto deleted!');

        return redirect('producto/productos');
    }
}
