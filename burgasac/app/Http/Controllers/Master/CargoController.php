<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Cargo;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cargos = Cargo::orderBy("id", "DESC")->paginate(25);

        return view('master.cargo.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cargo = new Cargo;

        return view('master.cargo.create', compact('cargo'));
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

        Cargo::create($requestData);

        Session::flash('flash_message', 'Tipo added!');

        return redirect('cargo');
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
        $cargo = Cargo::findOrFail($id);

        return view('master.cargo.show', compact('cargo'));
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
        $cargo = Cargo::findOrFail($id);

        return view('master.cargo.edit', compact('cargo'));
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
        
        $tipo = Cargo::findOrFail($id);
        $tipo->update($requestData);

        Session::flash('flash_message', 'Tipo Cargo actualizado!');

        return redirect('cargo');
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
        $cargo = Cargo::findOrFail($id);
        if (!is_null($cargo)) {
            $cargo->delete();
            $cargo->save();
        }

        Session::flash('flash_message', 'Cargo eliminado!');

        return redirect('cargo');
    }
}
