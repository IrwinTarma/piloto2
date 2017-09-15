<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Color;
use App\Proveedor;
use App\Producto;
use App\ProveedorColor;
use App\ProveedorColorProducto;
use DB;

class ProveedorColorProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //$data = Color::orderBy("id", "DESC")->paginate(25);
        $data = ProveedorColorProducto::select(
            "proveedor_color_producto.*",
            "pr.nombre_generico",
            "p.nombre_comercial",
            DB::raw("(CONCAT(c.nombre, '-', '')) AS color")

        )->leftJoin("color as c", "c.id", "=", "proveedor_color_producto.color_id")
        ->leftJoin("proveedores as p", "p.id", "=", "proveedor_color_producto.proveedor_id")
        ->leftJoin("productos as pr", "pr.id", "=", "proveedor_color_producto.producto_id")
        //->leftJoin("proveedor_color as pc", "pc.color_id", "=", "c.id")
        //->where("pc.color_id", "=", "proveedor_color_producto.color_id")
        //->where("pc.estado", "=", 1)
        ->whereRaw("proveedor_color_producto.deleted_at IS NULL")
        //->whereRaw("pc.deleted_at IS NULL")
        ->get();
        return view('master.proveedor_color_producto.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tipo_id = \Config::get("sistema.tipo_proveedor_tintoreria_id");
        $obj = new ProveedorColorProducto;
        $dataproveedores = Proveedor::select("proveedores.*")
          ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
          ->where("pt.tipo_proveedor_id", "=", $tipo_id)
          ->get();
        $proveedores = [];
        $proveedores[""] = "Selecciona";
        foreach ($dataproveedores as $key => $value) {
            $proveedores[$value->id] = $value->nombre_comercial;
        }
        $dataproductos = Producto::all();
        $productos = [];
        $productos[""] = "Selecciona";
        foreach ($dataproductos as $key => $value) {
            $productos[$value->id] = $value->nombre_generico;
        }
        return view('master.proveedor_color_producto.create', compact('obj', 'proveedores', 'productos'));
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
            'color_id'       => 'required',
        ]);

        ProveedorColorProducto::create($requestData);

        Session::flash('flash_message', 'Registro added!');

        return redirect('proveedor_color_producto');
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
        $tipo_id = \Config::get("sistema.tipo_proveedor_tintoreria_id");
        $obj = ProveedorColorProducto::find($id);
        $dataproveedores = Proveedor::select("proveedores.*")
          ->leftJoin("proveedor_tipo as pt", "pt.proveedor_id", "=", "proveedores.id")
          ->where("pt.tipo_proveedor_id", "=", $tipo_id)
          ->get();
        $proveedores = [];
        $proveedores[""] = "Selecciona";
        foreach ($dataproveedores as $key => $value) {
            $proveedores[$value->id] = $value->nombre_comercial;
        }
        $dataproductos = Producto::all();
        $productos = [];
        $productos[""] = "Selecciona";
        foreach ($dataproductos as $key => $value) {
            $productos[$value->id] = $value->nombre_generico;
        }

        return view('master.proveedor_color_producto.edit', compact('obj', 'proveedores', 'productos'));
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
        
        $obj = ProveedorColorProducto::findOrFail($id);
        $obj->update($requestData);

        Session::flash('flash_message', 'Registro actualizado!');

        return redirect('proveedor_color_producto');
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
        $color = ProveedorColorProducto::findOrFail($id);
        if (!is_null($color)) {
            $color->delete();
            $color->save();
        }

        Session::flash('flash_message', 'Cargo eliminado!');

        return redirect('proveedor_color_producto');
    }

    public function postColores(Request $request)
    {
        $proveedor_id = $request["proveedor_id"];
        $proveedor_id = $request["proveedor_id"];
        $colores = ProveedorColor::select(
            "proveedor_color_producto.color_id",
            DB::raw("(CONCAT(c.nombre, ' - ', '')) AS codigo_color")
        )
            ->leftJoin("color as c", "c.id", "=", "proveedor_color_producto.color_id")
            ->where(["proveedor_id" => $proveedor_id, "proveedor_color_producto.producto_id" => $producto_id])
            ->whereRaw("proveedor_color_producto.deleted_at IS NULL")->get();

        if (count($colores) > 0) {

            return response(["rst" => 1, "data" => $colores]);
        } else {
            return response(["rst" => 2, "msj" => "No hay colores para el proveedor!!!"]);
        }
    }

    public function postColoresproducto(Request $request)
    {
        $proveedor_id = $request["proveedor_id"];
        $producto_id = $request["producto_id"];

        $colores = ProveedorColorProducto::select(
            "proveedor_color_producto.*",
            DB::raw("(CONCAT(c.nombre, '-', pc.codigo)) AS codigocolor"),
            "p.nombre_comercial",
            "c.nombre as color"

        )->leftJoin("color as c", "c.id", "=", "proveedor_color_producto.color_id")
        ->leftJoin("proveedores as p", "p.id", "=", "proveedor_color_producto.proveedor_id")
        ->leftJoin("productos as pr", "pr.id", "=", "proveedor_color_producto.producto_id")
        ->leftJoin("proveedor_color as pc", "pc.color_id", "=", "c.id")
        ->where("proveedor_color_producto.proveedor_id", "=", $proveedor_id)
        ->where("proveedor_color_producto.producto_id", "=", $producto_id)
        ->whereRaw("proveedor_color_producto.deleted_at IS NULL")
        ->whereRaw("pc.deleted_at IS NULL")
        ->get();

        if (count($colores) > 0) {

            return response(["rst" => 1, "data" => $colores]);
        } else {
            return response(["rst" => 2, "msj" => "No hay colores para el proveedor!!!"]);
        }
    }
}
