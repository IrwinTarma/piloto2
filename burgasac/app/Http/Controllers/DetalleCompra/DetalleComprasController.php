<?php

namespace App\Http\Controllers\DetalleCompra;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DetalleCompra;
use Illuminate\Http\Request;
use Session;

class DetalleComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $detallecompras = DetalleCompra::paginate(25);

        return view('detalle-compras.index', compact('detallecompras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('detalle-compras.create');
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
        
        DetalleCompra::create($requestData);

        Session::flash('flash_message', 'DetalleCompra added!');

        return redirect('detallecompra/detalle-compras');
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
        $detallecompra = DetalleCompra::findOrFail($id);

        return view('detalle-compras.show', compact('detallecompra'));
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
        $detallecompra = DetalleCompra::findOrFail($id);

        return view('detalle-compras.edit', compact('detallecompra'));
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
        
        $detallecompra = DetalleCompra::findOrFail($id);
        $detallecompra->update($requestData);

        Session::flash('flash_message', 'DetalleCompra updated!');

        return redirect('detallecompra/detalle-compras');
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
        DetalleCompra::destroy($id);

        Session::flash('flash_message', 'DetalleCompra deleted!');

        return redirect('detallecompra/detalle-compras');
    }
}
