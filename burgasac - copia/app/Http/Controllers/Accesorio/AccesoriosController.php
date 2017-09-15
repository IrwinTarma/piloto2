<?php

namespace App\Http\Controllers\Accesorio;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Accesorio;
use Illuminate\Http\Request;
use Session;

use App\Proveedor;
use App\Titulo;

class AccesoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $accesorios = Accesorio::paginate(25);

        return view('accesorios.index', compact('accesorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $titulos = Titulo::where('materia_prima', 'accesorio')->get();
        $proveedores = Proveedor::all();

        return view('accesorios.create', compact('titulos', 'proveedores'));
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
        
        Accesorio::create($requestData);

        Session::flash('flash_message', 'Accesorio added!');

        return redirect('accesorio/accesorios');
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
        $accesorio = Accesorio::findOrFail($id);

        return view('accesorios.show', compact('accesorio'));
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
        $proveedores = Proveedor::all();
        $titulos = Titulo::where('materia_prima', 'accesorio')->get();

        $accesorio = Accesorio::findOrFail($id);

        return view('accesorios.edit', compact('accesorio', 'proveedores', 'titulos'));
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
        
        $accesorio = Accesorio::findOrFail($id);
        $accesorio->update($requestData);

        Session::flash('flash_message', 'Accesorio updated!');

        return redirect('accesorio/accesorios');
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
        Accesorio::destroy($id);

        Session::flash('flash_message', 'Accesorio deleted!');

        return redirect('accesorio/accesorios');
    }
}
