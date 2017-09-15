<?php

namespace App\Http\Controllers\CompraEstado;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CompraEstado;
use Illuminate\Http\Request;
use Session;

class CompraEstadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $compraestados = CompraEstado::paginate(25);

        return view('compra-estados.index', compact('compraestados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('compra-estados.create');
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

        $this->validate($request, [
            'nombre'       => 'required',
        ]);
        
        CompraEstado::create($requestData);

        Session::flash('flash_message', 'CompraEstado added!');

        return redirect('compraestado/compra-estados');
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
        $compraestado = CompraEstado::findOrFail($id);

        return view('compra-estados.show', compact('compraestado'));
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
        $compraestado = CompraEstado::findOrFail($id);

        return view('compra-estados.edit', compact('compraestado'));
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
        
        $compraestado = CompraEstado::findOrFail($id);
        $compraestado->update($requestData);

        Session::flash('flash_message', 'CompraEstado updated!');

        return redirect('compraestado/compra-estados');
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
        CompraEstado::destroy($id);

        Session::flash('flash_message', 'CompraEstado deleted!');

        return redirect('compraestado/compra-estados');
    }
}
