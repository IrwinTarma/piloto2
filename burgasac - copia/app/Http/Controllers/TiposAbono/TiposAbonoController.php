<?php

namespace App\Http\Controllers\TiposAbono;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TiposAbono;
use Illuminate\Http\Request;
use Session;

class TiposAbonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tipos_abono = TiposAbono::all();

        return view('tipos-abono.index', compact('tipos_abono'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipos_abono = TiposAbono::all();

        return view('tipos-abono.create', compact('tipos_abono'));
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
        
        TiposAbono::create($requestData);

        Session::flash('flash_message', 'TiposAbono added!');

        return redirect('tiposabono/tipos-abono');
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
        $tiposabono = TiposAbono::findOrFail($id);

        return view('tipos-abono.show', compact('tiposabono'));
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
        $tiposabono = TiposAbono::findOrFail($id);

        return view('tipos-abono.edit', compact('tiposabono'));
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
        
        $tiposabono = TiposAbono::findOrFail($id);
        $tiposabono->update($requestData);

        Session::flash('flash_message', 'TiposAbono updated!');

        return redirect('tiposabono/tipos-abono');
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
        TiposAbono::destroy($id);

        Session::flash('flash_message', 'TiposAbono deleted!');

        return redirect('tiposabono/tipos-abono');
    }
}
