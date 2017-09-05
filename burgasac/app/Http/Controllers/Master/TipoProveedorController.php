<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TipoProveedor;
use Illuminate\Http\Request;
use Session;

use App\Insumo;

class TipoProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tipos = TipoProveedor::orderBy("id", "DESC")->paginate(25);

        return view('master.tipo_proveedor.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipo = new TipoProveedor;

        return view('master.tipo_proveedor.create', compact('tipo'));
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
            'estado'      => 'required'
        ]);

        TipoProveedor::create($requestData);

        Session::flash('flash_message', 'Tipo added!');

        return redirect('tipo_proveedor');
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
        $tipo = TipoProveedor::findOrFail($id);

        return view('master.tipo_proveedor.show', compact('tipo'));
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
        $tipo = TipoProveedor::findOrFail($id);

        return view('master.tipo_proveedor.edit', compact('tipo'));
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
        
        $tipo = TipoProveedor::findOrFail($id);
        $tipo->update($requestData);

        Session::flash('flash_message', 'Tipo Proveedor updated!');

        return redirect('tipo_proveedor');
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
        $tipo = TipoProveedor::findOrFail($id);
        if (!is_null($tipo)) {
            $tipo->delete();
            $tipo->save();
        }

        Session::flash('flash_message', 'Tipo Proveedor deleted!');

        return redirect('tipo_proveedor');
    }
}
