<?php

namespace App\Http\Controllers\DetalleDevolucion;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DetalleDevolucione;
use Illuminate\Http\Request;
use Session;

class DetalleDevolucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $detalledevoluciones = DetalleDevolucione::paginate(25);

        return view('detalle-devoluciones.index', compact('detalledevoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('detalle-devoluciones.create');
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
        
        DetalleDevolucione::create($requestData);

        Session::flash('flash_message', 'DetalleDevolucione added!');

        return redirect('detalledevolucion/detalle-devoluciones');
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
        $detalledevolucione = DetalleDevolucione::findOrFail($id);

        return view('detalle-devoluciones.show', compact('detalledevolucione'));
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
        $detalledevolucione = DetalleDevolucione::findOrFail($id);

        return view('detalle-devoluciones.edit', compact('detalledevolucione'));
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
        
        $detalledevolucione = DetalleDevolucione::findOrFail($id);
        $detalledevolucione->update($requestData);

        Session::flash('flash_message', 'DetalleDevolucione updated!');

        return redirect('detalledevolucion/detalle-devoluciones');
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
        DetalleDevolucione::destroy($id);

        Session::flash('flash_message', 'DetalleDevolucione deleted!');

        return redirect('detalledevolucion/detalle-devoluciones');
    }
}
