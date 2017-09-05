<?php

namespace App\Http\Controllers\DetalleAbono;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DetalleAbono;
use Illuminate\Http\Request;
use Session;

class DetalleAbonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $detalleabonos = DetalleAbono::paginate(25);

        return view('detalle-abonos.index', compact('detalleabonos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('detalle-abonos.create');
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
        
        DetalleAbono::create($requestData);

        Session::flash('flash_message', 'DetalleAbono added!');

        return redirect('detalleabono/detalle-abonos');
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
        $detalleabono = DetalleAbono::findOrFail($id);

        return view('detalle-abonos.show', compact('detalleabono'));
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
        $detalleabono = DetalleAbono::findOrFail($id);

        return view('detalle-abonos.edit', compact('detalleabono'));
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
        
        $detalleabono = DetalleAbono::findOrFail($id);
        $detalleabono->update($requestData);

        Session::flash('flash_message', 'DetalleAbono updated!');

        return redirect('detalleabono/detalle-abonos');
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
        DetalleAbono::destroy($id);

        Session::flash('flash_message', 'DetalleAbono deleted!');

        return redirect('detalleabono/detalle-abonos');
    }
}
