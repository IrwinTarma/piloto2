<?php

namespace App\Http\Controllers\Abono;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Abono;
use Illuminate\Http\Request;
use Session;

use App\TiposAbono;
use App\Compra;
use App\DetalleCompra;
use App\Proveedor;
use App\Producto;
use App\DetalleAbono;

class AbonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $abonos = Abono::paginate(25);

        return view('abonos.index', compact('abonos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($compra_id)
    {
        $tipos_abono = TiposAbono::all();
        $productos = Producto::all();

        $compra = Compra::findOrFail($compra_id);

        $compra->detalles = DetalleCompra::where('compra_id', $compra->id)->get();
        $compra_detalles_json = json_encode($compra->detalles);

        return view('abonos.create', compact('productos', 'tipos_abono', 'compra', 'compra_detalles_json'));
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
            'tipoabono_id'      => 'required',
            'compra_id'         => 'required',
            'detalles'          => 'required',
        ],
        [
            'detalles.required' => 'Ingrese al menos una nota de abono al detalle.'
        ]);

        $abono_id = Abono::create($requestData)->id;
        
        if (isset($abono_id)){
            foreach ($requestData['detalles'] as $detalle) {
                $detalle['fecha']       = $detalle['fecha_registro'];
                $detalle['producto_id'] = $detalle['producto'];
                $detalle['abono_id']    = $abono_id;
                
                DetalleAbono::create($detalle);
            }
        }

        Session::flash('flash_message', 'Nota de Abono agregada!');

        return redirect('abono/abonos');
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
        $abono = Abono::findOrFail($id);

        return view('abonos.show', compact('abono'));
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
        $abono = Abono::findOrFail($id);
        $abono->detalles = DetalleAbono::where('abono_id', $abono->id)->get();

        //$tipos_abono = TiposAbono::pluck('nombre', 'id');
        $tipos_abono = TiposAbono::all();
        $productos = Producto::all();

        $compra = Compra::findOrFail($abono->compra_id);

        return view('abonos.edit', compact('abono', 'productos', 'tipos_abono', 'compra'));
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

        /*
         * validate($request, $rules, $messages)
         */
        $this->validate($request, [
            'fecha'             => 'date',
            'tipoabono_id'      => 'required',
            'compra_id'         => 'required',
            'detalles'          => 'required',
        ],
        [
            'detalles.required' => 'Ingrese al menos una nota de abono al detalle.'
        ]);

        $abono = Abono::findOrFail($id);
        $abono->update($requestData);
        
        DetalleAbono::where('abono_id', $id)->delete();
        foreach ($requestData['detalles'] as $detalle) {
            $detalle['fecha']       = $detalle['fecha_registro'];
            $detalle['producto_id'] = $detalle['producto'];
            $detalle['abono_id']    = $id;
            
            DetalleAbono::create($detalle);
        }

        Session::flash('flash_message', 'Abono updated!');

        return redirect('abono/abonos');
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
        Abono::destroy($id);

        Session::flash('flash_message', 'Abono deleted!');

        return redirect('abono/abonos');
    }

    public function compras()
    {
        $compras = Compra::orderBy('fecha', 'desc')
                        ->paginate(25);

        foreach ($compras as $key => $value) {
            $compras[$key]->nro_abonos = Abono::where('compra_id', $value->id)->count();
        }
        
        return view('abonos.compras', compact('compras'));
    }
}
