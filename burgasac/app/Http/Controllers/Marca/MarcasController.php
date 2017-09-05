<?php

namespace App\Http\Controllers\Marca;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Marca;
use Illuminate\Http\Request;
use Session;

use App\Insumo;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $marcas = Marca::paginate(25);

        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $insumos = Insumo::all();

        return view('marcas.create', compact('insumos'));
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

        Marca::create($requestData);

        Session::flash('flash_message', 'Marca added!');

        return redirect('marca/marcas');
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
        $marca = Marca::findOrFail($id);

        return view('marcas.show', compact('marca'));
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
        $insumos = Insumo::all();
        $marca = Marca::findOrFail($id);

        return view('marcas.edit', compact('marca', 'insumos'));
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
        
        $marca = Marca::findOrFail($id);
        $marca->update($requestData);

        Session::flash('flash_message', 'Marca updated!');

        return redirect('marca/marcas');
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
        Marca::destroy($id);

        Session::flash('flash_message', 'Marca deleted!');

        return redirect('marca/marcas');
    }
}
