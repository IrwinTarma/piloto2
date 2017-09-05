<?php

namespace App\Http\Controllers\Insumo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Insumo;
use Illuminate\Http\Request;
use Session;

use App\Titulo;

class InsumosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $insumos = Insumo::paginate(25);

        return view('insumos.index', compact('insumos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $titulos = Titulo::where('materia_prima', 'insumo')->get();
        $insumo = new Insumo;

        return view('insumos.create', compact('titulos', 'insumo'));
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
            'nombre_generico'  => 'required',
            'titulo_id'         => 'required',
        ]);
        
        Insumo::create($requestData);

        Session::flash('flash_message', 'Insumo added!');

        return redirect('insumo/insumos');
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
        $insumo = Insumo::findOrFail($id);

        return view('insumos.show', compact('insumo'));
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
        $titulos = Titulo::all();
        
        $insumo = Insumo::findOrFail($id);

        return view('insumos.edit', compact('insumo', 'titulos'));
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

        $insumo = Insumo::findOrFail($id);
        $insumo->update($requestData);

        Session::flash('flash_message', 'Insumo actualizado!');

        return redirect('insumo/insumos');
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
        $insumo = Insumo::find($id);
        if (!is_null($insumo)) {
            $insumo->delete();
            $insumo->save();
        }

        Session::flash('flash_message', 'Insumo deleted!');

        return redirect('insumo/insumos');
    }
}
