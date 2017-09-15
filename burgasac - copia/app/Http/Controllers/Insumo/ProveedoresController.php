<?php

namespace App\Http\Controllers\Insumo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proveedor;
use App\ProveedorTipo;
use App\Color;
use App\ProveedorColor;
use Illuminate\Http\Request;
use App\ObjectViews\Filtro;
use Session;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $objfiltro = new Filtro;
        $filtro = $objfiltro->filtroProveedor();
        $proveedores = Proveedor::orderBy("proveedores.id", "DESC")
            ->get();


        return view('proveedores.index', compact('proveedores', 'filtro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $objfiltro = new Filtro;
        $proveedor = new Proveedor;
        $tipo = $objfiltro->filtroProveedor()["tipo"];
        $seleccionado = [];
        $seleccionadocolor = [];
        $color = Color::where(["estado" => 1])->get();
        return view('proveedores.create', compact('proveedor', 'tipo', 'seleccionado', 'color', 'seleccionadocolor'));
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
        if (isset($requestData["tipo"])) {
            $tipo = $requestData["tipo"];
        } else {
            $tipo = [];
        }

        if (isset($requestData["color"])) {
            $color = $requestData["color"];
        } else {
            $color = [];
        }

        if (isset($requestData["codigo"])) {
            $codigo = $requestData["codigo"];
        } else {
            $codigo = [];
        }
        if (isset($requestData["tipo"])) {
            unset($requestData["tipo"]);
        }

        if (isset($requestData["color"])) {
            unset($requestData["color"]);
        }

        if (isset($requestData["codigo"])) {
            unset($requestData["codigo"]);
        }
        $this->validate($request, [
            'nombre_comercial'  => 'required',
            'ruc' => 'required|unique:proveedores'
        ]);
        
        $obj = Proveedor::create($requestData);
        foreach ($tipo as $key => $value) {
            ProveedorTipo::insert(["proveedor_id" => $obj->id, "tipo_proveedor_id" => $value]);
        }

        foreach ($color as $key => $value) {
            if (isset($codigo[$key])) {
                $insert = ["proveedor_id" => $obj->id, "color_id" => $value, "codigo" => $codigo[$key]];
                ProveedorColor::insert($insert);
            }
        }

        Session::flash('flash_message', 'Proveedores added!');

        return redirect('proveedor/proveedores');
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
        $objfiltro = new Filtro;
        $tipo = $objfiltro->filtroProveedor()["tipo"];
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.show', compact('proveedor'));
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
        $objfiltro = new Filtro;
        $tipo = $objfiltro->filtroProveedor()["tipo"];
        $proveedor = Proveedor::findOrFail($id);
        $data = ProveedorTipo::where(["proveedor_id" => $id])->get();
        $datacolor = ProveedorColor::where(["proveedor_id" => $id])->get();
        $seleccionado = [];
        $seleccionadocolor = [];
        foreach ($data as $key => $value) {
            $seleccionado[$value->tipo_proveedor_id] = $value;
        }

        foreach ($datacolor as $key => $value) {
            $seleccionadocolor[$value->color_id] = $value;
        }
        //dd($seleccionado);
        $color = Color::where(["estado" => 1])->get();
        return view('proveedores.edit', compact('proveedor', 'tipo', 'seleccionado', 'color', 'seleccionadocolor'));
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
        if (isset($requestData["tipo"])) {
            $tipo = $requestData["tipo"];
        } else {
            $tipo = [];
        }

        if (isset($requestData["color"])) {
            $color = $requestData["color"];
        } else {
            $color = [];
        }

        if (isset($requestData["codigo"])) {
            $codigo = $requestData["codigo"];
        } else {
            $codigo = [];
        }
        if (isset($requestData["tipo"])) {
            unset($requestData["tipo"]);
        }

        if (isset($requestData["color"])) {
            unset($requestData["color"]);
        }

        if (isset($requestData["codigo"])) {
            unset($requestData["codigo"]);
        }
        
        $proveedor = Proveedor::findOrFail($id);
        ProveedorTipo::where(["proveedor_id" => $id])->delete();

        $proveedor->update($requestData);
        foreach ($tipo as $key => $value) {
            ProveedorTipo::insert(["proveedor_id" => $proveedor->id, "tipo_proveedor_id" => $value]);
        }

        if (count($color) == 0) {
            ProveedorColor::where(["proveedor_id" => $proveedor->id, "estado" => 1])->whereRaw("deleted_at IS NULL")->update(["estado" => 0]);
        } else {
            ProveedorColor::where(["proveedor_id" => $proveedor->id])->whereRaw("deleted_at IS NULL")->update(["estado" => 0]);
            ProveedorColor::where(["proveedor_id" => $proveedor->id])->whereRaw("deleted_at IS NULL")->delete();
            foreach ($color as $key => $value) {
                if (isset($codigo[$key])) {
                    $insert = ["proveedor_id" => $proveedor->id, "color_id" => $value, "codigo" => $codigo[$key]];
                    ProveedorColor::insert($insert);
                }
            }
        }

        Session::flash('flash_message', 'Proveedores updated!');

        return redirect('proveedor/proveedores');
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
        $proveedor = Proveedor::find($id);
        if (!is_null($proveedor)) {
            $proveedor->delete();
            //$proveedor->save();
        }

        Session::flash('flash_message', 'Proveedores deleted!');

        return redirect('proveedor/proveedores');
    }
}
