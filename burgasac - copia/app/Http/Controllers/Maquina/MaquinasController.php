<?php

namespace App\Http\Controllers\Maquina;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Maquina;
use Illuminate\Http\Request;
use Session;

class MaquinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $maquinas = Maquina::paginate(25);

        return view('maquinas.index', compact('maquinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('maquinas.create');
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
        
        Maquina::create($requestData);

        Session::flash('flash_message', 'Maquina added!');

        return redirect('maquina/maquinas');
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
        $maquina = Maquina::findOrFail($id);

        return view('maquinas.show', compact('maquina'));
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
        $maquina = Maquina::findOrFail($id);

        return view('maquinas.edit', compact('maquina'));
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
        
        $maquina = Maquina::findOrFail($id);
        $maquina->update($requestData);

        Session::flash('flash_message', 'Maquina updated!');

        return redirect('maquina/maquinas');
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
        Maquina::destroy($id);

        Session::flash('flash_message', 'Maquina deleted!');

        return redirect('maquina/maquinas');
    }
}
