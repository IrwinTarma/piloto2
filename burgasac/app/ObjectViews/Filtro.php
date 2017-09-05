<?php
namespace App\ObjectViews;

use App\TipoProveedor;
use App\Producto;
use App\Proveedor;
use App\Color;
use Illuminate\Support\Facades\DB;
use Session;

class Filtro
{
	public function filtroProveedor()
	{
		if (!Session::has("filtroproveedor")) {
			$filtro["tipo"] = [];
			$tipo = TipoProveedor::where(["estado" => 1])->whereRaw("deleted_at IS NULL")->get();
			foreach ($tipo as $key => $value) {
				$filtro["tipo"][$value->id] = $value->nombre; 
			}

			Session::put("filtroproveedor", $filtro);
		}
		return Session::get("filtroproveedor");
	}

	public function filtroColor()
	{
		if (!Session::has("filtrocolor")) {
			$filtro["color"] = [];
			$filtro["color"][""] = "Seleccione";
			$colores = Color::where("estado", "=", 1)->orderBy("nombre", "ASC")->get();
			foreach ($colores as $key => $value) {
				$filtro["color"][$value->id] = $value->nombre;
			}
			Session::put("filtrocolor", $filtro);
		}
		return Session::get("filtrocolor");
	}

	public function filtroProducto()
	{
		if (!Session::has("filtroproducto")) {
			$filtro["producto"] = [];
			$filtro["producto"][""] = "Seleccione";
			$productos = Producto::orderBy("nombre_generico", "ASC")->get();
			foreach ($productos as $key => $value) {
				$filtro["producto"][$value->id] = $value->nombre_generico;
			}
			Session::put("filtroproducto", $filtro);
		}
		return Session::get("filtroproducto");
	}

	public function filtroDataProveedor()
	{
		if (!Session::has("filtrodataproveedor")) {
			$filtro["dataproveedor"] = [];
			$filtro["dataproveedor"][""] = "Seleccione";
			$productos = Proveedor::orderBy("nombre_comercial", "ASC")->get();
			foreach ($productos as $key => $value) {
				$filtro["dataproveedor"][$value->id] = $value->nombre_comercial;
			}
			Session::put("filtrodataproveedor", $filtro);
		}
		return Session::get("filtrodataproveedor");
	}

	public function filtroReporteBasico()
	{
		$filtro = [];
		$filtro["color"] = $this->filtroColor()["color"];
		$filtro["producto"] = $this->filtroProducto()["producto"];
		$filtro["proveedor"] = $this->filtroDataProveedor()["dataproveedor"];

		if (!Session::has("filtroreportebasico")) {
			Session::put("filtroreportebasico", $filtro);
		}
		return Session::get("filtroreportebasico");
	}
}