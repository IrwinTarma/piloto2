<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $colores = Color::orderBy("id", "DESC")->paginate(25);

        return view('master.color.index', compact('colores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $color = new Color;

        return view('master.color.create', compact('color'));
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

        Color::create($requestData);

        Session::flash('flash_message', 'Tipo added!');

        return redirect('color');
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
        $color = Color::findOrFail($id);

        return view('master.color.show', compact('color'));
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
        $color = Color::findOrFail($id);

        return view('master.color.edit', compact('color'));
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
        
        $tipo = Color::findOrFail($id);
        $tipo->update($requestData);

        Session::flash('flash_message', 'Tipo Cargo actualizado!');

        return redirect('color');
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
        $color = Color::findOrFail($id);
        if (!is_null($color)) {
            $color->delete();
            $color->save();
        }

        Session::flash('flash_message', 'Cargo eliminado!');

        return redirect('color');
    }
}
