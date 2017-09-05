<?php

namespace App\Http\Controllers\Titulo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Titulo;
use Illuminate\Http\Request;
use Session;

class TitulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $titulos = Titulo::paginate(25);

        return view('titulos.index', compact('titulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('titulos.create');
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
        
        Titulo::create($requestData);

        Session::flash('flash_message', 'Titulo agregado!');

        return redirect('titulo/titulos');
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
        $titulo = Titulo::findOrFail($id);

        return view('titulos.show', compact('titulo'));
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
        $titulo = Titulo::findOrFail($id);

        return view('titulos.edit', compact('titulo'));
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
        
        $titulo = Titulo::findOrFail($id);
        $titulo->update($requestData);

        Session::flash('flash_message', 'Titulo actualizado!');

        return redirect('titulo/titulos');
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
        Titulo::destroy($id);

        Session::flash('flash_message', 'Titulo eliminado!');

        return redirect('titulo/titulos');
    }
}
