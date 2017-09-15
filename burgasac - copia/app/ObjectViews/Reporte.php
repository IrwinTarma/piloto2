<?php
namespace App\ObjectViews;

use App\TipoProveedor;
use App\Producto;
use App\Proveedor;
use App\Color;
use App\ProveedorDespachoTintoreriaDeuda;
use Illuminate\Support\Facades\DB;

class Reporte
{
	public function despachoTintoreriaDeuda($filtro = [])
	{
		$resultado = ProveedorDespachoTintoreriaDeuda::select("proveedor_despacho_tintoreria_deuda.*",
				"pv.nombre_comercial as proveedor",
				"c.nombre as color",
				"pr.nombre_generico as producto")
			->leftJoin("proveedores as pv", "pv.id", "=", "proveedor_despacho_tintoreria_deuda.proveedor_id")
			->leftJoin("productos as pr", "pr.id", "=", "proveedor_despacho_tintoreria_deuda.producto_id")
			->leftJoin("color as c", "c.id", "=", "proveedor_despacho_tintoreria_deuda.color_id");
		if (isset($filtro["fecha"])) {
			$resultado->whereBetween("proveedor_despacho_tintoreria_deuda.created_at", $filtro["fecha"]);
		}

		if (isset($filtro["proveedor"])) {
			$resultado->where("proveedor_id", "=", $filtro["proveedor"]);
		}

		if (isset($filtro["color"])) {
			$resultado->where("color_id", "=", $filtro["color"]);
		}

		if (isset($filtro["producto"])) {
			$resultado->where("producto_id", "=", $filtro["color"]);
		}

		return $resultado;
	}
}