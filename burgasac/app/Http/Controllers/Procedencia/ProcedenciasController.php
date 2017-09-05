<?php

namespace App\Http\Controllers\Procedencia;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Procedencia;
use Illuminate\Http\Request;
use Session;

class ProcedenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $procedencias = Procedencia::paginate(25);

        return view('procedencias.index', compact('procedencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('procedencias.create');
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
        
        Procedencia::create($requestData);

        Session::flash('flash_message', 'Procedencia added!');

        return redirect('procedencias');
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
        $procedencia = Procedencia::findOrFail($id);

        return view('procedencias.show', compact('procedencia'));
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
        $procedencia = Procedencia::findOrFail($id);

        return view('procedencias.edit', compact('procedencia'));
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
        
        $procedencia = Procedencia::findOrFail($id);
        $procedencia->update($requestData);

        Session::flash('flash_message', 'Procedencia updated!');

        return redirect('procedencias');
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
        Procedencia::destroy($id);

        Session::flash('flash_message', 'Procedencia deleted!');

        return redirect('procedencias');
    }
}
