<?php

namespace App\Http\Controllers\Empleado;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Empleado;
use App\Cargo;
use Illuminate\Http\Request;
use Session;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $empleados = Empleado::paginate(25);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $empleado = new Empleado;
        $data = Cargo::all();
        $cargos = [];
        foreach ($data as $key => $value) {
            $cargos[$value->id] = $value->nombre;
        }
        return view('empleados.create', compact('empleado', 'cargos'));
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
            'fecha_nacimiento'  => 'required|date',
            'nombres'           => 'required',
            'apellidos'         => 'required',
        ],
        [
            'fecha_nacimiento.date' => 'Ingrese una fecha correcta.'
        ]);
        
        Empleado::create($requestData);

        Session::flash('flash_message', 'Empleado agregado!');

        return redirect('empleado/empleados');
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
        $empleado = Empleado::findOrFail($id);

        return view('empleados.show', compact('empleado'));
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
        $empleado = Empleado::findOrFail($id);
        $data = Cargo::all();
        $cargos = [];
        foreach ($data as $key => $value) {
            $cargos[$value->id] = $value->nombre;
        }

        return view('empleados.edit', compact('empleado', 'cargos'));
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
        
        $empleado = Empleado::findOrFail($id);
        $empleado->update($requestData);

        Session::flash('flash_message', 'Empleado updated!');

        return redirect('empleado/empleados');
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
        $empleado = Empleado::find($id);
        if (!is_null($empleado)) {
            $empleado->delete();
            $empleado->save();
        }

        Session::flash('flash_message', 'Empleado deleted!');

        return redirect('empleado/empleados');
    }
}
