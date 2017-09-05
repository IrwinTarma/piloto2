<?php

namespace App\Http\Controllers\Cronograma;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cronograma;
use Illuminate\Http\Request;
use Session;

use App\Banco;
use App\TiposPago;
use App\Compra;

use Carbon\Carbon;

class CronogramasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cronogramas = Cronograma::paginate(25);

        return view('cronogramas.index', compact('cronogramas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($compra_id = '')
    {
        $compra = Compra::findOrFail($compra_id);
        
        if(count($compra) == 1){
            $cronogramas = Cronograma::where('compra_id', $compra_id)->get();
            $bancos = Banco::all();
            $tipos_pago = TiposPago::all();

            return view('cronogramas.create', compact('bancos', 'tipos_pago', 'cronogramas', 'compra_id'));
        }
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

        /*
         * validate($request, $rules, $messages)
         */
        $this->validate($request, [
            'fecha'         => 'date|required',
            'monto'         => 'required',
        ]);

        Cronograma::create($requestData);

        Session::flash('flash_message', 'Cronograma agregado!');

        return redirect('cronograma/cronogramas/create/' . $requestData['compra_id']);
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
        $cronograma = Cronograma::findOrFail($id);

        return view('cronogramas.show', compact('cronograma'));
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
        $cronograma = Cronograma::findOrFail($id);

        return view('cronogramas.edit', compact('cronograma'));
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
        
        $cronograma = Cronograma::findOrFail($id);
        $cronograma->update($requestData);

        Session::flash('flash_message', 'Cronograma actualizado!');

        return redirect('cronograma/cronogramas');
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
        $cronograma = Cronograma::select('compra_id')->where('id', $id)->get();

        Cronograma::destroy($id);
        Session::flash('flash_message', 'Cronograma eliminado!');

        return redirect('cronograma/cronogramas/create/' . $cronograma[0]->compra_id);
    }
}
