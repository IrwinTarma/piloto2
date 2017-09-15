<?php namespace App\Http\Controllers\Reportes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ObjectViews\Filtro;

use DB;
use PDF;
use App;
use App\ObjectViews\Reporte;

class ReporteDespachoController extends Controller implements ReporteInterfaceController
{
	public function index(Request $request)
	{
		$objreporte = new Reporte;
		$filtro = [];
			if ($request->fechafiltro!="") {
				$from = $request->fechafiltro." 00:00:00";
				$to = $request->fechafiltro." 23:59:59";
				$filtro["fecha"] = [$from, $to];
			}
			if ($request->proveedorfiltro) {
				$filtro["proveedor"] = $request->proveedorfiltro;
			}

			if ($request->colorfiltro) {
				$filtro["color"] = $request->colorfiltro;
			}

			if ($request->productofiltro) {
				$filtro["producto"] = $request->productofiltro;
			}
		if ($request->flag){
			return ReporteDespachoController::getPdf($filtro);
		}
		if ($request->ajax()) {
	
			$deudas = $objreporte->despachoTintoreriaDeuda($filtro);
			$deudas = $deudas->get();
			//$deudas
			//$deudas = ProveedorDespachoTintoreriaDeuda::all();
			
			return response(["draw" => 1, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => $deudas ]);
		}
		$objfiltro = new Filtro;
		$filtro = $objfiltro->filtroReporteBasico();
		return view("reportes.proveedor_tela_deuda.index", $filtro);
	}

	public static function getPdf($filtro)
	{
		$objreporte = new Reporte;
		$data = $objreporte->despachoTintoreriaDeuda($filtro)->get();
		$pdf = App::make('dompdf.wrapper');
		$html = "";
		$html.="<div style='font-family: Helvetica, font-size:12px'>";
		$html.="<h1>Reporte de Deuda por Tintorería </h1>";
		$html.="<p>F. Reporte: ".date('Y-m-d h:i:s a')."</p>";
		$html.="<div>";
			$html.="<table>";
			$html.="<thead>";
			$html.="<tr>";
			$html.="<th style='text-align:center; border: solid 1px; width: 100px;'>Fecha</th>";
			$html.="<th style='text-align:center; border: solid 1px; width: 200px;'>Producto</th>";
			$html.="<th style='text-align:center; border: solid 1px; width: 120px;'>Proveedor</th>";
			$html.="<th style='text-align:center; border: solid 1px; width: 80px;'>Color</th>";
			$html.="<th style='text-align:center; border: solid 1px; width: 80px;'>Peso (kg)</th>";
			$html.="<th style='text-align:center; border: solid 1px; width: 80px;'>Total</th>";

			$html.="</tr>";
			$html.="</thead>";

			$html.="<tbody>";
			$html.="</tbody>";
			foreach ($data as $key => $value) {
				$html.="<tr>";
					$html.="<td style='text-align:center; width: 100px;'>".date('Y-m-d', strtotime($value->created_at))."</td>";
					$html.="<td style='text-align:center; width: 200px;'>$value->producto</td>";
					$html.="<td style='text-align:center; width: 200px;'>$value->proveedor</td>";
					$html.="<td>$value->color</td>";
					$html.="<td>$value->peso</td>";
					$html.="<td>$value->total</td>";
				$html.="</tr>";
			}
			
			$html.="</table>";

		$html.="</div>";
		$html.="</div>";
		$pdf->loadHTML($html)->setPaper('a4', 'landscape');
		//$pdf->loadHTML($html);
		return $pdf->stream();
	}
}