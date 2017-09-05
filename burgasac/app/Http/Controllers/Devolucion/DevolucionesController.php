<?php

namespace App\Http\Controllers\Devolucion;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Devolucion;
use App\Proveedor;
use Illuminate\Http\Request;
use Session;

use App\Compra;
use App\DetalleCompra;
use App\DetalleDevolucion;
use App\Resumen_Stock_MP;
use App\Movimiento_MP;

class DevolucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $devoluciones = Devolucion::paginate(25);

        return view('devoluciones.index', compact('devoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($compra_id)
    {
        $compra = Compra::with("detalles")->findOrFail($compra_id);
        $proveedores = Proveedor::all();
        $detalles = $compra->detalles;
        
        for ($i=0; $i < count($detalles) ; $i++) {
            $resumen_stock_mp = Resumen_Stock_MP::where("lote",$compra->detalles[$i]['nro_lote'])
                                            ->orderBy("created_at","DESC")
                                            ->first();
            //existe lote en resumen_stock_materiaprima?
            if (count($resumen_stock_mp) == 1){
                //actualizar valor de peso bruto con el valor de cantidad de resumen_stock_materiaprima
                $compra->detalles[$i]['peso_bruto'] = $resumen_stock_mp['cantidad'] + $compra->detalles[$i]['peso_tara'];
            }

            /* FALTA si peso_bruto = peso_tara no agregar al detalle de compra */
        }

        $compra_detalles_json = json_encode($compra->detalles);

        return view('devoluciones.create', compact('compra', 'compra_detalles_json','proveedores'));
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

        /*
         * validate($request, $rules, $messages)
         */
        $this->validate($request, [
            'fecha'             => 'date',
            'tipo_devolucion'   => 'required',
            'compra_id'         => 'required',
            'detalles'          => 'required',
        ],
        [
            'detalles.required' => 'Ingrese al menos una devolucion al detalle.'
        ]);

        $devolucion_id = Devolucion::create($requestData)->id;
        $compra = Compra::find($requestData["compra_id"]);

        if (isset($devolucion_id)){
            foreach ($requestData['detalles'] as $detalle) {

                $detalle['fecha'] = $detalle['fecha_registro'];
                $detalle['devolucion_id']     = $devolucion_id;

                $insumo_id = isset($detalle["insumo_id"])? $detalle["insumo_id"] : 0;
                $accesorio_id =  isset($detalle["accesorio_id"])? $detalle["accesorio_id"]:0;
                Resumen_Stock_MP::calculateCurrentStock($detalle["nro_lote"],$insumo_id, $accesorio_id, $compra->proveedor_id ,($detalle["peso_bruto"]));
                $movimiento = array(
                  "fecha" => $compra->fecha,
                  "compra_id"=>$compra->id,
                  "proveedor_id"=>$compra->proveedor_id,
                  "lote" => $detalle["nro_lote"],
                  "titulo_id" => $detalle["titulo"],
                  "cantidad"=>(-($detalle["peso_bruto"])),
                  "estado"=>0
                );
                $movimiento["insumo_id"] = $insumo_id;
                $movimiento["accesorio_id"] = $accesorio_id;
                $movimiento["descripcion"] = "Devolucion";
                Movimiento_MP::create($movimiento);

                DetalleDevolucion::create($detalle);
            }
        }

        Session::flash('flash_message', 'Devolucione added!');

        return redirect('devolucion/devoluciones');
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
        $devolucion = Devolucion::findOrFail($id);

        $devolucion->detalles = DetalleDevolucion::where('devolucion_id', $devolucion->id)->get();

        return view('devoluciones.show', compact('devolucion'));
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
        $devolucione = Devolucion::findOrFail($id);

        return view('devoluciones.edit', compact('devolucione'));
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

        $devolucione = Devolucion::findOrFail($id);
        $devolucione->update($requestData);

        Session::flash('flash_message', 'Devolucione updated!');

        return redirect('devolucion/devoluciones');
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
        Devolucion::destroy($id);

        Session::flash('flash_message', 'Devolucione deleted!');

        return redirect('devolucion/devoluciones');
    }

    public function compras()
    {
        $compras = Compra::orderBy('fecha', 'desc')
                        ->where('estado',2)
                        ->paginate(25);

        foreach ($compras as $key => $value) {
            $compras[$key]->nro_devoluciones = Devolucion::where('compra_id', $value->id)->count();
        }

        return view('devoluciones.compras', compact('compras'));
    }
}
