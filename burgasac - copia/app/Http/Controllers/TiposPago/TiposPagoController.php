<?php

namespace App\Http\Controllers\TiposPago;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TiposPago;
use Illuminate\Http\Request;
use Session;

class TiposPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tipospago = TiposPago::paginate(25);

        return view('tipos-pago.index', compact('tipospago'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tipos-pago.create');
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
        
        TiposPago::create($requestData);

        Session::flash('flash_message', 'TiposPago added!');

        return redirect('tipospago/tipos-pago');
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
        $tipospago = TiposPago::findOrFail($id);

        return view('tipos-pago.show', compact('tipospago'));
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
        $tipospago = TiposPago::findOrFail($id);

        return view('tipos-pago.edit', compact('tipospago'));
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
        
        $tipospago = TiposPago::findOrFail($id);
        $tipospago->update($requestData);

        Session::flash('flash_message', 'TiposPago updated!');

        return redirect('tipospago/tipos-pago');
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
        TiposPago::destroy($id);

        Session::flash('flash_message', 'TiposPago deleted!');

        return redirect('tipospago/tipos-pago');
    }
}
