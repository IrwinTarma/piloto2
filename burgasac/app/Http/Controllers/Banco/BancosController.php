<?php

namespace App\Http\Controllers\Banco;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Banco;
use Illuminate\Http\Request;
use Session;

class BancosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bancos = Banco::paginate(25);

        return view('bancos.index', compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('bancos.create');
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
        
        Banco::create($requestData);

        Session::flash('flash_message', 'Banco added!');

        return redirect('banco/bancos');
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
        $banco = Banco::findOrFail($id);

        return view('bancos.show', compact('banco'));
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
        $banco = Banco::findOrFail($id);

        return view('bancos.edit', compact('banco'));
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
        
        $banco = Banco::findOrFail($id);
        $banco->update($requestData);

        Session::flash('flash_message', 'Banco updated!');

        return redirect('banco/bancos');
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
        Banco::destroy($id);

        Session::flash('flash_message', 'Banco deleted!');

        return redirect('banco/bancos');
    }
}
